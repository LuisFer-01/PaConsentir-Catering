<?php

namespace App\Filament\Admin\Resources\Categorias\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('descripcion'),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
