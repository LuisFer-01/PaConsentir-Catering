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

class RolResource extends Resource
{
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
                    ->modalWidth('7xl')
                    ->form(fn ($record) => static::getPermissionForm($record))
                    ->action(fn ($record, array $data) => static::savePermissions($record, $data)),
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
        $permisos = Permiso::where('estado', 1)->get();
        $asignados = $record->detallePermiso?->pluck('ruta', 'permiso_id')->toArray() ?? [];

        $form = [];

        foreach ($resources as $resource) {
            $resourceName = class_basename($resource);
            $label = static::getResourceLabel($resource);

            $form[] = Section::make($label)
                ->schema([
                    Grid::make(5)->schema([
                        // Gestión Total
                        Checkbox::make("total_{$resourceName}")
                            ->label('Gestión Total')
                            ->live()
                            ->afterStateUpdated(function ($state, $set, $get) use ($resourceName) {
                                $set("create_{$resourceName}", $state);
                                $set("read_{$resourceName}", $state);
                                $set("update_{$resourceName}", $state);
                                $set("delete_{$resourceName}", $state);
                            }),

                        // Permisos individuales
                        Checkbox::make("create_{$resourceName}")
                            ->label('Crear')
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => static::updateTotal($state, $get, $set, $resourceName)),

                        Checkbox::make("read_{$resourceName}")
                            ->label('Leer')
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => static::updateTotal($state, $get, $set, $resourceName)),

                        Checkbox::make("update_{$resourceName}")
                            ->label('Actualizar')
                            ->live()
                            ->afterStateUpdated(fn ($state, $set, $get) => static::updateTotal($state, $get, $set, $resourceName)),

                        Checkbox::make("delete_{$resourceName}")
                            ->label('Borrar')
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

        // Desactivar todos los anteriores
        $record->detallePermiso()->update(['estado' => 0]);

        foreach ($resources as $resource) {
            $name = class_basename($resource);
            $baseRoute = static::getBaseRoute($resource);

            $permisos = [
                'create' => $data["create_{$name}"] ?? false,
                'read'   => $data["read_{$name}"] ?? false,
                'update' => $data["update_{$name}"] ?? false,
                'delete' => $data["delete_{$name}"] ?? false,
            ];

            foreach ($permisos as $accion => $enabled) {
                if (!$enabled) continue;

                $ruta = static::generateRoute($baseRoute, $accion);
                $permiso = Permiso::where('nombre', ucfirst($accion) === 'Read' ? 'Solo Lectura' : ucfirst($accion))
                    ->first();

                if (!$permiso) continue;

                DetallePermiso::updateOrCreate(
                    ['rol_id' => $record->id_rol, 'permiso_id' => $permiso->id, 'ruta' => $ruta],
                    ['grupo' => static::getGrupo($resource), 'estado' => 1]
                );
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