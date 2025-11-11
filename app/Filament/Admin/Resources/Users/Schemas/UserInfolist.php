<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Facades\Storage;

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
                    ->label('CI')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->label('Direccion')
                    ->placeholder('-'),
                ImageEntry::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->height(120)
                    ->width(120)
                    ->defaultImageUrl(asset('users/default-avatar-01.png'))
                    ->url(fn ($record) => $record->photo 
                        ? Storage::url($record->photo) 
                        : asset('users/default-avatar-01.png')
                    )
                    ->placeholder('-'),
                TextEntry::make('rol.nombre')
                    ->label('Rol')
                    ->numeric(),
                IconEntry::make('estado')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
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
