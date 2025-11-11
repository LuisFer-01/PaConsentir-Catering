<?php

namespace App\Filament\Admin\Resources\Platos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use App\Models\Menu;
use Filament\Forms\Components\FileUpload;

class PlatoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('descripcion')
                    ->label('Descripción'),
                TextInput::make('precio')
                    ->label('Precio')
                    ->required()
                    ->numeric(),
                TextInput::make('cantidad')
                    ->label('Cantidad')
                    ->required()
                    ->numeric(),
                Select::make('menu_id')
                    ->label('Menu')
                    ->options(Menu::all()->pluck('nombre', 'id_menu'))
                    ->required(),
                    //->numeric(),
                FileUpload::make('img_ruta')
                    ->label('Imagen')
                    ->image()
                    ->directory('platos')
                    ->visibility('public')
                    ->maxSize(2048) // 2MB
                    ->imagePreviewHeight('150')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('300')
                    ->imageResizeTargetHeight('300')
                    ->placeholder('Selecciona una imagen'),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
