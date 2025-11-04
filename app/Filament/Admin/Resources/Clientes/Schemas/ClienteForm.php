<?php

namespace App\Filament\Admin\Resources\Clientes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('apellido'),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('direccion'),
                TextInput::make('ci'),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
