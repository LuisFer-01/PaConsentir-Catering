<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\Rol;
use Filament\Forms\Components\Select;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('lastname')
                    ->label('Apellido')
                    ->required(),
                TextInput::make('email')
                    ->label('Correo')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(),
                TextInput::make('phone')
                    ->label('Telefono')
                    ->tel(),
                TextInput::make('ci'),
                TextInput::make('address')
                    ->label('Dirección'),
                TextInput::make('photo')
                    ->label('Foto'),
                Select::make('rol_id')
                    ->label('Rol')
                    ->options(Rol::query()->pluck('nombre', 'id_rol'))
                    ->required(),
                    //->numeric(),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
