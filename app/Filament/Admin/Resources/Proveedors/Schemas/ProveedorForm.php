<?php

namespace App\Filament\Admin\Resources\Proveedors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProveedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('contacto')
                    ->label('Contacto'),
                TextInput::make('telefono')
                    ->label('Telefono')
                    ->tel(),
                TextInput::make('email')
                    ->label('Correo')
                    ->email(),
                TextInput::make('direccion')
                    ->label('Direccion'),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
