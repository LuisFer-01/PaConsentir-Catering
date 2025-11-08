<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\Rol;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Hash;

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
                    ->required(fn (string $operation): bool => $operation === 'create') // Solo al crear
                    ->dehydrated(fn ($state) => filled($state)) // No guardar si está vacío
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                TextInput::make('phone')
                    ->label('Telefono')
                    ->tel(),
                TextInput::make('ci')
                    ->label('CI'),
                TextInput::make('address')
                    ->label('Dirección'),
                FileUpload::make('photo')
                    ->label('Foto de Perfil')
                    ->image()
                    ->directory('users')
                    ->visibility('public')
                    ->maxSize(2048) // 2MB
                    ->imagePreviewHeight('150')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('300')
                    ->imageResizeTargetHeight('300')
                    ->placeholder('Selecciona una imagen'),
                Select::make('rol_id')
                    ->label('Rol')
                    ->options(Rol::where('estado', 1)->pluck('nombre', 'id_rol'))
                    ->required(),
                    //->numeric(),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
