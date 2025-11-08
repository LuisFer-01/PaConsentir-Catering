<?php

namespace App\Filament\Admin\Resources\UndMedidas\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UndMedidaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre')
                    ->label('Nombre')
                    ->placeholder('-'),
                TextEntry::make('descripcion')
                    ->label('Descripcion')
                    ->placeholder('-'),
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
