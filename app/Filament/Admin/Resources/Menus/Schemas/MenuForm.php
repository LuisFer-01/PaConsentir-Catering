<?php

namespace App\Filament\Admin\Resources\Menus\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('descripcion'),
                DatePicker::make('fecha_inicio')
                    ->required(),
                DatePicker::make('fecha_fin'),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
