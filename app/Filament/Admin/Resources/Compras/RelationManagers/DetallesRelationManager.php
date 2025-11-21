<?php

namespace App\Filament\Admin\Resources\Compras\RelationManagers;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
//use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Schemas\Schema;
//use Filament\Tables;
//use Filament\Resources\Form;
//use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
//use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Forms\Form;

class DetallesRelationManager extends RelationManager
{
    protected static string $relationship = 'detalles';
    protected static ?string $title = 'Detalle de Compra';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('producto_id')
                    ->label('Producto')
                    ->relationship('producto', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if (!$state) return;
                        $producto = \App\Models\Producto::find($state);
                        if ($producto) {
                            $cantidad = $get('cantidad') ?? 1;
                            $set('precio_unitario', $producto->precio);
                            $set('subtotal', $producto->precio * $cantidad);
                        }
                    }),

                Forms\Components\TextInput::make('cantidad')
                    ->label('Cantidad')
                    ->numeric()
                    ->minValue(0.01)
                    ->step(0.01)
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $get, $set) =>
                        $set('subtotal', $state * ($get('precio_unitario') ?? 0))
                    ),

                Forms\Components\TextInput::make('precio_unitario')
                    ->label('Precio Unitario')
                    ->numeric()
                    ->prefix('Bs')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $get, $set) =>
                        $set('subtotal', $state * ($get('cantidad') ?? 0))
                    ),

                Forms\Components\TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->prefix('Bs')
                    ->disabled()
                    ->dehydrated(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('producto.nombre')
                    ->label('Producto')
                    ->searchable(),
                TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('precio_unitario')
                    ->money('Bs')
                    ->sortable(),
                TextColumn::make('subtotal')
                    ->money('Bs')
                    ->summarize(Tables\Columns\Summarizers\Sum::make()->label('Total')),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Agregar Producto')
                    ->modalHeading('Agregar producto a la compra')
                    ->after(function () {
                        // Actualizar totalcost de la compra
                        $this->actualizarTotalCompra();
                    }),
            ])
            ->actions([
                EditAction::make()
                    ->after(function () {
                        $this->actualizarTotalCompra();
                    }),
                DeleteAction::make()
                    ->after(function () {
                        $this->actualizarTotalCompra();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->after(function () {
                            $this->actualizarTotalCompra();
                        }),
                ]),
            ]);
    }
    protected function actualizarTotalCompra(): void
    {
        $total = $this->ownerRecord->detalles()->sum('subtotal');

        $this->ownerRecord->updateQuietly([
            'totalcost' => $total
        ]);
    }
}
