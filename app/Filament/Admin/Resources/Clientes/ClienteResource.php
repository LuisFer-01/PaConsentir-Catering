<?php

namespace App\Filament\Admin\Resources\Clientes;

use App\Filament\Admin\Resources\Clientes\Pages\CreateCliente;
use App\Filament\Admin\Resources\Clientes\Pages\EditCliente;
use App\Filament\Admin\Resources\Clientes\Pages\ListClientes;
use App\Filament\Admin\Resources\Clientes\Pages\ViewCliente;
use App\Filament\Admin\Resources\Clientes\Schemas\ClienteForm;
use App\Filament\Admin\Resources\Clientes\Schemas\ClienteInfolist;
use App\Filament\Admin\Resources\Clientes\Tables\ClientesTable;
use App\Models\Cliente;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Traits\AuthorizesWithPermission;

class ClienteResource extends Resource
{
    use AuthorizesWithPermission;
    protected static ?string $model = Cliente::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationLabel(): string
    {
        return 'Gestionar Cliente';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Gestionar Clientes';
    }

    public static function getModelLabel(): string
    {
        return 'Cliente';
    }

    public static function form(Schema $schema): Schema
    {
        return ClienteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ClienteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClientesTable::configure($table);
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
            'index' => ListClientes::route('/'),
            'create' => CreateCliente::route('/create'),
            'view' => ViewCliente::route('/{record}'),
            'edit' => EditCliente::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'VENTA';
    }
}
