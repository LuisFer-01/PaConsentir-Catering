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
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Checkbox;
use Filament\Notifications\Notification;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class RolResource extends Resource
{
    protected static ?string $model = Rol::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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

                // BOTÓN: Configurar Permisos
                Action::make('permisos')
                    ->label('Permisos')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->modalHeading(fn ($record) => "Permisos del Rol: {$record->nombre}")
                    ->modalSubmitActionLabel('Guardar Permisos')
                    ->modalCancelActionLabel('Cancelar')
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
    // MÉTODOS PARA EL MODAL DE PERMISOS
    // ===================================================================

    /**
     * Formulario del modal: Checkbox por cada permiso
     */
    public static function getPermissionForm($record): array
    {
        $permisos = Permiso::where('estado', 1)->get();
        $asignados = $record->detallePermiso->pluck('permiso_id')->toArray();

        return [
            Grid::make(3)
                ->schema(
                    $permisos->map(function ($permiso) use ($asignados) {
                        return Checkbox::make("permiso_{$permiso->id}")
                            ->label($permiso->nombre)
                            ->default(in_array($permiso->id, $asignados));
                    })->toArray()
                ),
        ];
    }

    /**
     * Guardar permisos seleccionados en detalle_permiso
     */
    public static function savePermissions($record, array $data): void
    {
        // Obtener IDs de permisos seleccionados
        $selectedIds = collect($data)
            ->filter(fn ($value, $key) => $value && Str::startsWith($key, 'permiso_'))
            ->map(fn ($value, $key) => (int) Str::after($key, 'permiso_'))
            ->values()
            ->toArray();

        // Eliminar anteriores (borrado lógico)
        $record->detallePermiso()->update(['estado' => 0]);

        // Crear nuevos
        foreach ($selectedIds as $permisoId) {
            $permiso = Permiso::find($permisoId);
            if (!$permiso) continue;

            // Generar ruta según permiso
            $ruta = static::generateRouteForPermission($permiso->nombre, $record);
            $grupo = static::getGrupoForRol($record);

            DetallePermiso::create([
                'rol_id' => $record->id_rol,
                'permiso_id' => $permisoId,
                'ruta' => $ruta,
                'grupo' => $grupo,
                'estado' => 1,
            ]);
        }

        Notification::make()
            ->title('Permisos actualizados correctamente')
            ->success()
            ->send();
    }

    /**
     * Genera ruta dinámica según tipo de permiso
     */
    private static function generateRouteForPermission(string $nombre, $record): string
    {
        $base = '/admin/resources/rols'; // Cambia según el módulo
        return match ($nombre) {
            'Gestión Total' => "$base/*",
            'Adición' => "$base/create",
            'Edición' => "$base/{record}/edit",
            'Eliminación' => "$base/{record}",
            'Solo Lectura' => $base,
            default => $base,
        };
    }

    /**
     * Grupo según rol
     */
    private static function getGrupoForRol($record): string
    {
        return match ($record->nombre) {
            'Administrador' => 'ADMINISTRACIÓN',
            'Vendedor' => 'VENTA',
            'Almacén' => 'COMPRA',
            default => 'OTROS',
        };
    }
}