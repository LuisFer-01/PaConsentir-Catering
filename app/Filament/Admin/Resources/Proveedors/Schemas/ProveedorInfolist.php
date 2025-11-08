<?php

namespace App\Filament\Admin\Resources\Proveedors\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProveedorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre')
                    ->label('Nombre')
                    ->placeholder('-'),
                TextEntry::make('contacto')
                    ->label('Contacto')
                    ->placeholder('-'),
                TextEntry::make('telefono')
                    ->label('Telefono')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Correo')
                    ->placeholder('-'),
                TextEntry::make('direccion')
                    ->label('Direccion')
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
