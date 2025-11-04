<?php

namespace App\Filament\Admin\Resources\Menus\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MenuInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('descripcion')
                    ->placeholder('-'),
                TextEntry::make('fecha_inicio')
                    ->date(),
                TextEntry::make('fecha_fin')
                    ->date()
                    ->placeholder('-'),
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
