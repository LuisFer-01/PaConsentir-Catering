<?php

namespace App\Filament\Admin\Resources\Compras\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ComprasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('proveedor.nombre')
                    ->label('Proveedor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('usuario.name')
                    ->label('Usuario')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipodocumento.nombre')
                    ->label('Tipo Documento')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipopago.nombre')
                    ->label('Tipo Pago')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('totalcost')
                    ->label('Costo Total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                IconColumn::make('estado')
                    ->label('Fecha')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                CreateAction::make(),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
