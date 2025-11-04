<?php

namespace App\Filament\Admin\Resources\Pagos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PagoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('venta_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tipopago_id')
                    ->required()
                    ->numeric(),
                TextInput::make('monto')
                    ->required()
                    ->numeric(),
                DatePicker::make('fecha_pago')
                    ->required(),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
