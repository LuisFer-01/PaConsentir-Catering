<?php

namespace App\Filament\Admin\Resources\Rols\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;

class RolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('descripcion'),
                Toggle::make('estado')
                    ->required(),
            ]);
    }
}
