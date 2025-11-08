<?php

namespace App\Filament\Admin\Resources\TipoDocumentos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TipoDocumentoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('descripcion')
                    ->label('Descripcion'),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
