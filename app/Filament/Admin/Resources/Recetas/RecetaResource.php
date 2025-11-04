<?php

namespace App\Filament\Admin\Resources\Recetas;

use App\Filament\Admin\Resources\Recetas\Pages\CreateReceta;
use App\Filament\Admin\Resources\Recetas\Pages\EditReceta;
use App\Filament\Admin\Resources\Recetas\Pages\ListRecetas;
use App\Filament\Admin\Resources\Recetas\Pages\ViewReceta;
use App\Filament\Admin\Resources\Recetas\Schemas\RecetaForm;
use App\Filament\Admin\Resources\Recetas\Schemas\RecetaInfolist;
use App\Filament\Admin\Resources\Recetas\Tables\RecetasTable;
use App\Models\Receta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecetaResource extends Resource
{
    protected static ?string $model = Receta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Receta';

    public static function form(Schema $schema): Schema
    {
        return RecetaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RecetaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RecetasTable::configure($table);
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
            'index' => ListRecetas::route('/'),
            'create' => CreateReceta::route('/create'),
            'view' => ViewReceta::route('/{record}'),
            'edit' => EditReceta::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'PARÁMETROS';
    }
}
