<?php

namespace App\Filament\Admin\Resources\Ventas\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VentaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('cliente.nombre')
                    ->label('Cliente')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('usuario.name')
                    ->label('Usuario')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('tipodocumento.nombre')
                    ->label('Tipo Documento')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('tipopago.nombre')
                    ->label('Tipo Pago')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('totalprec')
                    ->label('Precio Total')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('fecha')
                    ->label('Fecha')
                    ->date(),
                IconEntry::make('estado')
                    ->label('Estado')
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
