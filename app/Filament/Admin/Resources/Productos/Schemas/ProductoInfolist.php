<?php

namespace App\Filament\Admin\Resources\Productos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Facades\Storage;

class ProductoInfolist
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
                TextEntry::make('categoria.nombre')
                    ->label('Categoria')
                    ->numeric(),
                TextEntry::make('undmedida.nombre')
                    ->label('Unidad de Medida')
                    ->numeric(),
                ImageEntry::make('img_ruta')
                    ->label('Imagen')
                    ->circular()
                    ->height(120)
                    ->width(120)
                    ->defaultImageUrl(asset('productos/default-product-01.png'))
                    ->url(fn ($record) => $record->img_ruta 
                        ? Storage::url($record->img_ruta) 
                        : asset('productos/default-product-01.png')
                    )
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
