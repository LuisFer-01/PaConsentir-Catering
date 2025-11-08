<?php

namespace App\Filament\Admin\Resources\Clientes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClienteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre')
                    ->label('Nombre'),
                TextEntry::make('apellido')
                    ->label('Apellido')
                    ->placeholder('-'),
                TextEntry::make('telefono')
                    ->label('Telefono')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Correo')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('direccion')
                    ->label('Direccion')
                    ->placeholder('-'),
                TextEntry::make('ci')
                    ->label('CI')
                    ->placeholder('-'),
                IconEntry::make('estado')
                    ->label('Estado')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Creado en')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Actualizado en')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
