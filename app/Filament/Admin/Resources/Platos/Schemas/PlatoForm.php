<?php

namespace App\Filament\Admin\Resources\Platos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlatoForm
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
                TextInput::make('menu_id')
                    ->numeric(),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
