<?php

namespace App\Filament\Admin\Resources\Productos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use App\Models\UndMedida;
use App\Models\Categoria;

class ProductoForm
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
                Select::make('categoria_id')
                    ->label('Categoria')
                    ->options(Categoria::where('estado', 1)->pluck('nombre', 'id_categoria'))
                    ->required(),
                    //->numeric(),
                Select::make('undmedida_id')
                    ->label('Unidad de Medida')
                    ->options(UndMedida::where('estado', 1)->pluck('nombre', 'id_undmedida'))
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
                TextInput::make('cnt_minima')
                    ->label('Cantidad Minima')
                    ->required()
                    ->numeric(),
                TextInput::make('cnt_actual')
                    ->label('Cantidad Actual')
                    ->required()
                    ->numeric(),
                TextInput::make('cnt_maxima')
                    ->label('Cantidad Maxima')
                    ->required()
                    ->numeric(),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
