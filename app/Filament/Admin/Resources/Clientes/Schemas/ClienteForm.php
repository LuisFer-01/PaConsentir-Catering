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
                    ->label('Nombre')
                    ->required(),
                TextInput::make('apellido')
                    ->label('Apellido'),
                TextInput::make('telefono')
                    ->label('Telefono')
                    ->tel(),
                TextInput::make('email')
                    ->label('Correo')
                    ->label('Email address')
                    ->email(),
                TextInput::make('direccion')
                    ->label('Direccion'),
                TextInput::make('ci')
                    ->label('CI'),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
