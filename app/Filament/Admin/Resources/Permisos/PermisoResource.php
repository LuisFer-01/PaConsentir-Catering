<?php

namespace App\Filament\Admin\Resources\Permisos;

use App\Filament\Admin\Resources\Permisos\Pages\CreatePermiso;
use App\Filament\Admin\Resources\Permisos\Pages\EditPermiso;
use App\Filament\Admin\Resources\Permisos\Pages\ListPermisos;
use App\Filament\Admin\Resources\Permisos\Pages\ViewPermiso;
use App\Filament\Admin\Resources\Permisos\Schemas\PermisoForm;
use App\Filament\Admin\Resources\Permisos\Schemas\PermisoInfolist;
use App\Filament\Admin\Resources\Permisos\Tables\PermisosTable;
use App\Models\Permiso;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermisoResource extends Resource
{
    protected static ?string $model = Permiso::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Permiso';
    public static function getNavigationLabel(): string
    {
        return 'Gestionar Permiso';
    }
    public static function form(Schema $schema): Schema
    {
        return PermisoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PermisoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PermisosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPermisos::route('/'),
            'create' => CreatePermiso::route('/create'),
            'view' => ViewPermiso::route('/{record}'),
            'edit' => EditPermiso::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'ADMINISTRACIÓN';
    }
}
