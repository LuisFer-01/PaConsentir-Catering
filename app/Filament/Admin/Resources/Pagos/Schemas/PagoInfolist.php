<?php

namespace App\Filament\Admin\Resources\Pagos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PagoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('venta_id')
                    ->numeric(),
                TextEntry::make('tipopago_id')
                    ->numeric(),
                TextEntry::make('monto')
                    ->numeric(),
                TextEntry::make('fecha_pago')
                    ->date(),
                IconEntry::make('estado')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
