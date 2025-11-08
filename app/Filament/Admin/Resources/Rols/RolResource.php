<?php

namespace App\Filament\Admin\Resources\Rols;

use App\Filament\Admin\Resources\Rols\Pages\CreateRol;
use App\Filament\Admin\Resources\Rols\Pages\EditRol;
use App\Filament\Admin\Resources\Rols\Pages\ListRols;
use App\Filament\Admin\Resources\Rols\Pages\ViewRol;
use App\Filament\Admin\Resources\Rols\Schemas\RolForm;
use App\Filament\Admin\Resources\Rols\Schemas\RolInfolist;
use App\Filament\Admin\Resources\Rols\Tables\RolsTable;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\DetallePermiso;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
//use Filament\Forms\Components\Section;
//use Filament\Forms\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Facades\Filament;
use App\Filament\Traits\AuthorizesWithPermission;

class RolResource extends Resource
{
    use AuthorizesWithPermission;
    protected static ?string $model = Rol::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Document;

    public static function getNavigationLabel(): string
    {
        return 'Gestionar Rol';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Gestionar Roles';
    }

    public static function getModelLabel(): string
    {
        return 'Rol';
    }

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return RolForm::configure($schema);
    }

    public static function infolist(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return RolInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolsTable::configure($table)
            ->actions([
                ViewAction::make(),
                EditAction::make(),

                Action::make('permisos')
                    ->label('Permisos')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->modalHeading(fn ($record) => "Permisos del Rol: {$record->nombre}")
                    ->modalSubmitActionLabel('Guardar Permisos')
                    ->modalWidth('4xl')
                    ->form(fn ($record) => static::getPermissionForm($record))
                    ->action(fn ($record, array $data) => static::savePermissions($record, $data)),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                // Si usas algún scope global, quítalo
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRols::route('/'),
            'create' => CreateRol::route('/create'),
            'view' => ViewRol::route('/{record}'),
            'edit' => EditRol::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'ADMINISTRACIÓN';
    }

    // ===================================================================
    // MODAL DE PERMISOS POR RECURSO
    // ===================================================================

    public static function getPermissionForm($record): array
    {
        $resources = Filament::getResources();
        $detallePermisos = $record->detallePermisos()
            ->where('estado', 1)
            ->get()
            ->keyBy(fn($dp) => $dp->permiso->ruta); // clave: ruta del permiso

        $form = [];

        foreach ($resources as $resource) {
            $resourceName = class_basename($resource);
            $label = static::getResourceLabel($resource);
            $baseRoute = static::getBaseRoute($resource);

            // Rutas esperadas
            $rutas = [
                'total'  => "$baseRoute/*",
                'create' => "$baseRoute/create",
                'read'   => $baseRoute,
                'update' => "$baseRoute/{record}/edit",
                'delete' => "$baseRoute/{record}",
            ];

            // Estado de cada permiso
            $permisos = [
                'total'  => $detallePermisos->has($rutas['total']),
                'create' => $detallePermisos->has($rutas['create']),
                'read'   => $detallePermisos->has($rutas['read']),
                'update' => $detallePermisos->has($rutas['update']),
                'delete' => $detallePermisos->has($rutas['delete']),
            ];

            $form[] = Section::make($label)
                ->schema([
                    Grid::make(5)->schema([
                        Checkbox::make("total_{$resourceName}")
                            ->label('Gestión Total')
                            ->default($permisos['total'])
                            ->live()
                            ->afterStateUpdated(function ($state, $set) use ($resourceName) {
                                $set("create_{$resourceName}", $state);
                                $set("read_{$resourceName}", $state);
                                $set("update_{$resourceName}", $state);
                                $set("delete_{$resourceName}", $state);
                            }),

                        Checkbox::make("create_{$resourceName}")
                            ->label('Crear')
                            ->default($permisos['create'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => static::updateTotal($state, $get, $set, $resourceName)),

                        Checkbox::make("read_{$resourceName}")
                            ->label('Leer')
                            ->default($permisos['read'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => static::updateTotal($state, $get, $set, $resourceName)),

                        Checkbox::make("update_{$resourceName}")
                            ->label('Actualizar')
                            ->default($permisos['update'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => static::updateTotal($state, $get, $set, $resourceName)),

                        Checkbox::make("delete_{$resourceName}")
                            ->label('Borrar')
                            ->default($permisos['delete'])
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => static::updateTotal($state, $get, $set, $resourceName)),
                    ]),
                ])
                ->collapsible()
                ->collapsed();
        }

        return $form;
    }

    private static function updateTotal($state, $get, $set, $resourceName)
    {
        $allChecked = $get("create_{$resourceName}") &&
                    $get("read_{$resourceName}") &&
                    $get("update_{$resourceName}") &&
                    $get("delete_{$resourceName}");

        $set("total_{$resourceName}", $allChecked);
    }

    private static function getResourceLabel($resource): string
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

    public static function savePermissions($record, array $data): void
    {
        $resources = Filament::getResources();

        // Desactivar todos
        $record->detallePermisos()->update(['estado' => 0]);

        foreach ($resources as $resource) {
            $name = class_basename($resource);
            $baseRoute = static::getBaseRoute($resource);

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
                    ['rol_id' => $record->id_rol, 'permiso_id' => $permiso->id_permiso],
                    ['estado' => 1]
                );
            }

            // Gestión Total
            $totalKey = "total_{$name}";
            if (!empty($data[$totalKey])) {
                $permisoTotal = Permiso::where('ruta', "$baseRoute/*")->first();
                if ($permisoTotal) {
                    DetallePermiso::updateOrCreate(
                        ['rol_id' => $record->id_rol, 'permiso_id' => $permisoTotal->id_permiso],
                        ['estado' => 1]
                    );
                }
            }
        }

        Notification::make()
            ->title('Permisos actualizados')
            ->success()
            ->send();
    }

    private static function getBaseRoute($resource): string
    {
        return '/admin/resources/' . strtolower(str_replace('Resource', '', class_basename($resource)));
    }

    private static function generateRoute(string $base, string $accion): string
    {
        return match ($accion) {
            'create' => "$base/create",
            'read'   => $base,
            'update' => "$base/{record}/edit",
            'delete' => "$base/{record}",
            default  => $base,
        };
    }

    private static function getGrupo($resource): string
    {
        $name = class_basename($resource);
        return match (true) {
            str_contains($name, 'User') || str_contains($name, 'Rol') || str_contains($name, 'Permiso') => 'ADMINISTRACIÓN',
            str_contains($name, 'Producto') || str_contains($name, 'Categoria') => 'PARÁMETROS',
            str_contains($name, 'Proveedor') || str_contains($name, 'Compra') => 'COMPRA',
            str_contains($name, 'Cliente') || str_contains($name, 'Venta') || str_contains($name, 'Pago') => 'VENTA',
            default => 'OTROS',
        };
    }
}