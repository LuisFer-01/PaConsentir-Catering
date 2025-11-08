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
                    ->label('Nombre')
                    ->required(),
                TextInput::make('descripcion')
                    ->label('Descripcion'),
                DatePicker::make('fecha_inicio')
                    ->label('Fecha Inicio')
                    ->required(),
                DatePicker::make('fecha_fin')
                    ->label('Fecha Fin'),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
