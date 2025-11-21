<?php

namespace App\Filament\Admin\Resources\Ventas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;

class VentaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Venta')
                    ->columns(2)
                    ->schema([
                        Select::make('cliente_id')
                            ->relationship('cliente', 'nombre')
                            ->searchable()
                            ->preload()
                            ->nullable(),

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
                    ]),

                Section::make('Detalle de Venta')
                    ->schema([
                        Repeater::make('detalles')
                            ->relationship('detalles')
                            ->schema([
                                Select::make('plato_id')
                                    ->label('Plato')
                                    ->relationship('plato', 'nombre')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get, $livewire) {
                                        if (!$state) return;

                                        $plato = \App\Models\Plato::with('recetas.ingrediente')->find($state);
                                        if (!$plato) return;

                                        $cantidad = $get('cantidad') ?? 1;
                                        $set('precio_unitario', $plato->precio);
                                        $set('subtotal', $plato->precio * $cantidad);

                                        // Validar stock
                                        foreach ($plato->recetas as $receta) {
                                            $necesario = $receta->cantidad * $cantidad;
                                            $disponible = $receta->ingrediente->cnt_actual ?? 0;

                                            if ($disponible < $necesario) {
                                                Notification::make()
                                                    ->danger()
                                                    ->title('Stock Insuficiente')
                                                    ->body("No hay suficiente {$receta->ingrediente->nombre}. Faltan " . ($necesario - $disponible))
                                                    ->persistent()
                                                    ->send();
                                                $livewire->halt();
                                            }
                                        }

                                        // Forzar actualización del total
                                        $livewire->data['totalprec'] = collect($livewire->data['detalles'] ?? [])->sum('subtotal');
                                    }),

                                TextInput::make('cantidad')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, $get, $set, $livewire) => 
                                        $set('subtotal', $state * ($get('precio_unitario') ?? 0))
                                            && $livewire->data['totalprec'] = collect($livewire->data['detalles'] ?? [])->sum('subtotal')
                                    ),

                                TextInput::make('precio_unitario')
                                    ->label('Precio Unitario (Bs)')
                                    ->numeric()
                                    ->prefix('Bs ')
                                    ->disabled()
                                    ->dehydrated(true),

                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->prefix('Bs ')
                                    ->disabled()
                                    ->dehydrated(true),
                            ])
                            ->columns(4)
                            ->defaultItems(1)
                            ->addActionLabel('Agregar plato')
                            ->collapsible()
                            ->cloneable()
                            ->afterStateUpdated(fn ($livewire) => 
                                $livewire->data['totalprec'] = collect($livewire->data['detalles'] ?? [])->sum('subtotal')
                            )
                            ->deleteAction(fn ($action) => $action->after(fn ($livewire) => 
                                $livewire->data['totalprec'] = collect($livewire->data['detalles'] ?? [])->sum('subtotal')
                            )),
                    ]),

                Section::make('Total de la Venta')
                    ->schema([
                        TextInput::make('totalprec')
                            ->label('Total Precio (Bs)')
                            ->numeric()
                            ->prefix('Bs ')
                            ->readOnly()
                            ->dehydrated(true)     // ← CLAVE: permite que se envíe al servidor
                            ->default(0)
                            ->live()               // ← CLAVE: escucha cambios en tiempo real
                            ->reactive(),
                    ]),
            ])
            ->columns(1);
    }
}
