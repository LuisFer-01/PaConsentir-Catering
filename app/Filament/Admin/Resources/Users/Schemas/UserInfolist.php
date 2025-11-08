<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('lastname')
                    ->label('Apellido')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Correo'),
                TextEntry::make('phone')
                    ->label(label: 'Telefono')
                    ->placeholder('-'),
                TextEntry::make('ci')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->label('Direccion')
                    ->placeholder('-'),
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(asset('users/default-avatar-01.png'))
                    ->height(70)
                    ->placeholder('-'),
                TextEntry::make('rol_id')
                    ->label('Rol')
                    ->numeric(),
                IconEntry::make('estado')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
