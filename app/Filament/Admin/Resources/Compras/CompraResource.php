<?php

namespace App\Filament\Admin\Resources\Compras;

use App\Filament\Admin\Resources\Compras\Pages\CreateCompra;
use App\Filament\Admin\Resources\Compras\Pages\EditCompra;
use App\Filament\Admin\Resources\Compras\Pages\ListCompras;
use App\Filament\Admin\Resources\Compras\Pages\ViewCompra;
use App\Filament\Admin\Resources\Compras\Schemas\CompraForm;
use App\Filament\Admin\Resources\Compras\Schemas\CompraInfolist;
use App\Filament\Admin\Resources\Compras\Tables\ComprasTable;
//use App\Filament\Admin\Resources\Compras\RelationManagers\DetalleComprasRelationManager;
use App\Filament\Admin\Resources\Compras\RelationManagers\DetallesRelationManager;
use App\Filament\Traits\AuthorizesWithPermission;
use App\Models\Compra;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompraResource extends Resource
{
    use AuthorizesWithPermission;

    protected static ?string $model = Compra::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingCart;
    protected static ?string $recordTitleAttribute = 'id_compra';

    public static function getNavigationLabel(): string
    {
        return 'Gestionar Compra';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Gestionar Compras';
    }

    public static function getModelLabel(): string
    {
        return 'Compra';
    }

    public static function form(Schema $schema): Schema
    {
        return CompraForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompraInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComprasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            DetallesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompras::route('/'),
            'create' => CreateCompra::route('/create'),
            'view' => ViewCompra::route('/{record}'),
            'edit' => EditCompra::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'COMPRA';
    }
}
