<?php

namespace App\Filament\Admin\Resources\Recetas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RecetaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('plato_id')
                    ->required()
                    ->numeric(),
                TextInput::make('ingrediente_id')
                    ->required()
                    ->numeric(),
                TextInput::make('cantidad')
                    ->required()
                    ->numeric(),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
