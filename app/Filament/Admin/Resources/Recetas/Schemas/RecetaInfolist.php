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
                TextEntry::make('plato_id')
                    ->numeric(),
                TextEntry::make('ingrediente_id')
                    ->numeric(),
                TextEntry::make('cantidad')
                    ->numeric(),
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
