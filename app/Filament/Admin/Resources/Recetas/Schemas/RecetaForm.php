<?php

namespace App\Filament\Admin\Resources\Recetas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\Plato;
use App\Models\Producto;
use Filament\Forms\Components\Select;

class RecetaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('plato_id')
                    ->label('Plato')
                    ->options(Plato::where('estado', 1)->pluck('nombre', 'id_plato')/* ->where('estado', 1) */)
                    ->required(),
                Select::make('ingrediente_id')
                    ->label('Ingrediente')
                    ->options(Producto::where('estado', 1)->pluck('nombre', 'id_producto')/* ->where('estado', 1) */)
                    ->required(),
                TextInput::make('cantidad')
                    ->label('Cantidad')
                    ->required()
                    ->numeric(),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
