<?php

namespace App\Filament\Admin\Resources\Permisos\Pages;

use App\Filament\Admin\Resources\Permisos\PermisoResource;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Schemas\Components\Form;
//use Filament\Forms\Form;
use Filament\Notifications\Notification;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\DetallePermiso;
use Filament\Facades\Filament;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Actions\Action;

class AssignPermissions extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = PermisoResource::class;
    protected string $view = 'filament.admin.resources.permiso-resource.pages.assign-permissions';

    public ?array $data = [];
    public $selectedRol = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('selectedRol')
                    ->label('Seleccionar Rol')
                    ->options(Rol::pluck('nombre', 'id_rol'))
                    ->reactive()
                    ->afterStateUpdated(fn ($state) => $this->loadPermissions($state)),
            ])
            ->statePath('data');
    }

    protected function getFormSchema(): array
    {
        if (!$this->selectedRol) {
            return [];
        }

        $rol = Rol::find($this->selectedRol);
        if (!$rol) return [];

        $resources = Filament::getResources();
        $detallePermisos = $rol->detallePermisos()
            ->where('estado', 1)
            ->with('permiso')
            ->get()
            ->keyBy(fn($dp) => $dp->permiso->ruta);

        $sections = [];

        foreach ($resources as $resource) {
            $resourceName = class_basename($resource);
            $label = $this->getResourceLabel($resource);
            $baseRoute = $this->getBaseRoute($resource);

            $rutas = [
                'total'  => "$baseRoute/*",
                'create' => "$baseRoute/create",
                'read'   => $baseRoute,
                'update' => "$baseRoute/{record}/edit",
                'delete' => "$baseRoute/{record}",
            ];

            $permisos = [
                'total'  => $detallePermisos->has($rutas['total']),
                'create' => $detallePermisos->has($rutas['create']),
                'read'   => $detallePermisos->has($rutas['read']),
                'update' => $detallePermisos->has($rutas['update']),
                'delete' => $detallePermisos->has($rutas['delete']),
            ];

            $sections[] = Section::make($label)
                ->schema([
                    Grid::make(5)->schema([
                        Forms\Components\Checkbox::make("total_{$resourceName}")
                            ->label('Gestión Total')
                            ->default($permisos['total'])
                            ->live()
                            ->afterStateUpdated(function ($state, $set) use ($resourceName) {
                                $set("create_{$resourceName}", $state);
                                $set("read_{$resourceName}", $state);
                                $set("update_{$resourceName}", $state);
                                $set("delete_{$resourceName}", $state);
                            }),

                        Forms\Components\Checkbox::make("create_{$resourceName}")
                            ->label('Crear')
                            ->default($permisos['create'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => $this->updateTotal($state, $get, $set, $resourceName)),

                        Forms\Components\Checkbox::make("read_{$resourceName}")
                            ->label('Leer')
                            ->default($permisos['read'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => $this->updateTotal($state, $get, $set, $resourceName)),

                        Forms\Components\Checkbox::make("update_{$resourceName}")
                            ->label('Actualizar')
                            ->default($permisos['update'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => $this->updateTotal($state, $get, $set, $resourceName)),

                        Forms\Components\Checkbox::make("delete_{$resourceName}")
                            ->label('Borrar')
                            ->default($permisos['delete'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => $this->updateTotal($state, $get, $set, $resourceName)),
                    ]),
                ])
                ->collapsible()
                ->collapsed();
        }

        return $sections;
    }

    private function updateTotal($state, $get, $set, $resourceName)
    {
        $allChecked = $get("create_{$resourceName}") &&
                      $get("read_{$resourceName}") &&
                      $get("update_{$resourceName}") &&
                      $get("delete_{$resourceName}");
        $set("total_{$resourceName}", $allChecked);
    }

    public function loadPermissions($rolId)
    {
        $this->selectedRol = $rolId;
        $this->form->fill(['selectedRol' => $rolId]);
    }

    public function save()
    {
        $data = $this->form->getState();
        $rol = Rol::find($this->selectedRol);
        if (!$rol) return;

        $resources = Filament::getResources();
        $rol->detallePermisos()->update(['estado' => 0]);

        foreach ($resources as $resource) {
            $name = class_basename($resource);
            $baseRoute = $this->getBaseRoute($resource);

            $acciones = [
                'create' => "$baseRoute/create",
                'read'   => $baseRoute,
                'update' => "$baseRoute/{record}/edit",
                'delete' => "$baseRoute/{record}",
            ];

            foreach ($acciones as $accion => $ruta) {
                $key = "{$accion}_{$name}";
                if (empty($data[$key])) continue;

                $permiso = Permiso::where('ruta', $ruta)->first();
                if (!$permiso) continue;

                DetallePermiso::updateOrCreate(
                    ['rol_id' => $rol->id_rol, 'permiso_id' => $permiso->id_permiso],
                    ['estado' => 1]
                );
            }

            if (!empty($data["total_{$name}"])) {
                $permisoTotal = Permiso::where('ruta', "$baseRoute/*")->first();
                if ($permisoTotal) {
                    DetallePermiso::updateOrCreate(
                        ['rol_id' => $rol->id_rol, 'permiso_id' => $permisoTotal->id_permiso],
                        ['estado' => 1]
                    );
                }
            }
        }

        Notification::make()
            ->title('Permisos actualizados para ' . $rol->nombre)
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar Permisos')
                ->submit('save'),
        ];
    }

    private function getResourceLabel($resource): string
    {
        $name = class_basename($resource);
        return match ($name) {
            'UserResource' => 'Usuarios',
            'ProductoResource' => 'Productos',
            'CategoriaResource' => 'Categorías',
            'ProveedorResource' => 'Proveedores',
            'CompraResource' => 'Compras',
            'ClienteResource' => 'Clientes',
            'VentaResource' => 'Ventas',
            'PagoResource' => 'Pagos',
            default => Str::headline(str_replace('Resource', '', $name)),
        };
    }

    private function getBaseRoute($resource): string
    {
        return '/admin/resources/' . strtolower(str_replace('Resource', '', class_basename($resource)));
    }
}