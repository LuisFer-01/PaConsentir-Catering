<?php

namespace App\Filament\Admin\Resources\Compras\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\TipoDocumento;
use App\Models\TipoPago;

class CompraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('proveedor_id')
                    ->label('Proveedor')
                    ->options(Proveedor::all()->pluck('nombre', 'id_proveedor'))
                    ->required(),
                Select::make('usuario_id')
                    ->label('Usuario')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('tipodocumento_id')
                    ->label('Tipo Documento')
                    ->options(TipoDocumento::all()->pluck('nombre', 'id_tipodocumento'))
                    ->required(),
                Select::make('tipopago_id')
                    ->label('Tipo Documento')
                    ->options(TipoPago::all()->pluck('nombre', 'id_tipopago'))
                    ->required(),
                TextInput::make('totalcost')
                    ->label('Costo Total')
                    ->required()
                    ->numeric(),
                DatePicker::make('fecha')
                    ->label('Fecha')
                    ->required(),
                Toggle::make('estado')
                    ->label('Estado')
                    ->required(),
            ]);
    }
}
