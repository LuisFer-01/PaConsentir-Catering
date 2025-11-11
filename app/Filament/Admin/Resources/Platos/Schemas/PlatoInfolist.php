<?php

namespace App\Filament\Admin\Resources\Platos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;

class PlatoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre')
                    ->label('Nombre')
                    ->placeholder('-'),
                TextEntry::make('descripcion')
                    ->label('Descripción')
                    ->placeholder('-'),
                TextEntry::make('precio')
                    ->label('Precio')
                    ->numeric(),
                TextEntry::make('menu.nombre')
                    ->label('Menu')
                    ->numeric()
                    ->placeholder('-'),
                ImageColumn::make('img_ruta')
                    ->label('Imagen')
                    ->circular()
                    ->defaultImageUrl(asset('platos/default-plato-01.png'))
                    ->height(70)
                    ->placeholder('-'),
                IconEntry::make('estado')
                    ->label('Estado')
                    ->boolean(),
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
