<?php

namespace App\Filament\Admin\Resources\Recetas\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RecetaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('plato.nombre')
                    ->label('Plato'),
                TextEntry::make('ingrediente.nombre')
                    ->label('Ingrediente'),
                TextEntry::make('cantidad')
                    ->label('Cantidad')
                    ->numeric(),
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
