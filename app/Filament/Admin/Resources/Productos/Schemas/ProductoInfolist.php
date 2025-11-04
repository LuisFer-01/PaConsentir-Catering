<?php

namespace App\Filament\Admin\Resources\Productos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('descripcion')
                    ->placeholder('-'),
                TextEntry::make('precio')
                    ->numeric(),
                TextEntry::make('categoria_id')
                    ->numeric(),
                TextEntry::make('undmedida_id')
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
