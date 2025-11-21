<?php

namespace App\Filament\Admin\Resources\Compras\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
//use Filament\Schemas\Get;
//use Filament\Schemas\Set;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Placeholder;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\TipoDocumento;
use App\Models\TipoPago;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class CompraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información General')
                    ->schema([
                        Select::make('proveedor_id')
                            ->relationship('proveedor', 'nombre')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('usuario_id')
                            ->relationship('usuario', 'name')
                            ->default(auth()->id())
                            ->disabledOn('edit')
                            ->required(),

                        Select::make('tipodocumento_id')
                            ->relationship('tipoDocumento', 'nombre')
                            ->required(),

                        Select::make('tipopago_id')
                            ->relationship('tipoPago', 'nombre')
                            ->required(),

                        DatePicker::make('fecha')
                            ->default(now())
                            ->required(),
                    ])->columns(2),

                Section::make('Total')
                    ->schema([
                        Placeholder::make('total_compra')
                            ->label('Total de la Compra')
                            ->content(function (Get $get) {
                                $total = collect($get('detalles'))->sum(fn ($item) => $item['subtotal'] ?? 0);
                                return 'Bs ' . number_format($total, 2);
                            })
                            ->reactive(),
                    ]),

                Section::make('Detalle de Compra')
                    ->schema([
                        Repeater::make('detalles')
                            ->relationship('detalles')
                            ->schema([
                                Select::make('producto_id')
                                    ->label('Producto')
                                    ->relationship('producto', 'nombre')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $producto = \App\Models\Producto::find($state);
                                        if ($producto) {
                                            $cantidad = $get('cantidad') ?? 1;
                                            $set('precio_unitario', $producto->precio);
                                            $set('subtotal', $producto->precio * $cantidad);
                                        }
                                    }),

                                TextInput::make('cantidad')
                                    ->numeric()
                                    ->minValue(0.01)
                                    ->step(0.01)
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, $get, $set) =>
                                        $set('subtotal', $state * ($get('precio_unitario') ?? 0))
                                    ),

                                TextInput::make('precio_unitario')
                                    ->label('Precio Unitario (Bs)')
                                    ->numeric()
                                    ->prefix('Bs ')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, $get, $set) =>
                                        $set('subtotal', $state * ($get('cantidad') ?? 1))
                                    ),

                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->prefix('Bs ')
                                    ->disabled()
                                    ->dehydrated(true),
                            ])
                            ->columns(4)
                            ->defaultItems(1)
                            ->reorderable(false)
                            ->addActionLabel('Agregar producto')
                            ->collapsible()
                            ->cloneable(),
                    ]),
            ])
            ->columns(2);
    }
}
