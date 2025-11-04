<?php

namespace App\Filament\Admin\Resources\Productos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('descripcion'),
                TextInput::make('precio')
                    ->required()
                    ->numeric(),
                TextInput::make('categoria_id')
                    ->required()
                    ->numeric(),
                TextInput::make('undmedida_id')
                    ->required()
                    ->numeric(),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
