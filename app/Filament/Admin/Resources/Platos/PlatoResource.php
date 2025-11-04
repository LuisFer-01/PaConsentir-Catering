<?php

namespace App\Filament\Admin\Resources\Platos;

use App\Filament\Admin\Resources\Platos\Pages\CreatePlato;
use App\Filament\Admin\Resources\Platos\Pages\EditPlato;
use App\Filament\Admin\Resources\Platos\Pages\ListPlatos;
use App\Filament\Admin\Resources\Platos\Pages\ViewPlato;
use App\Filament\Admin\Resources\Platos\Schemas\PlatoForm;
use App\Filament\Admin\Resources\Platos\Schemas\PlatoInfolist;
use App\Filament\Admin\Resources\Platos\Tables\PlatosTable;
use App\Models\Plato;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlatoResource extends Resource
{
    protected static ?string $model = Plato::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Plato';

    public static function form(Schema $schema): Schema
    {
        return PlatoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PlatoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlatosTable::configure($table);
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
            'index' => ListPlatos::route('/'),
            'create' => CreatePlato::route('/create'),
            'view' => ViewPlato::route('/{record}'),
            'edit' => EditPlato::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'PARÁMETROS';
    }
}
