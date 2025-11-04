<?php

namespace App\Filament\Admin\Resources\TipoPagos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TipoPagoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('descripcion'),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
