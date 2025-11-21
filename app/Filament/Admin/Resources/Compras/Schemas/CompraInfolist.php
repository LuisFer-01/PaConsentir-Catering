<?php

namespace App\Filament\Admin\Resources\Compras\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CompraInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('proveedor.nombre')
                    ->label('Proveedor')
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
                TextEntry::make('totalcost')
                    ->label('Costo Total')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('fecha')
                    ->label('Fecha')
                    ->date()
                    ->placeholder('-'),
                IconEntry::make('estado')
                    ->label('Estado')
                    ->boolean()
                    ->placeholder('-'),
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
