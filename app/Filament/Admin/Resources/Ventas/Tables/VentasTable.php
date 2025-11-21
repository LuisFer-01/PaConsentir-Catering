<?php

namespace App\Filament\Admin\Resources\Ventas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VentasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cliente.nombre')
                    ->label('Cliente')
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
                TextColumn::make('totalprec')
                    ->label('Precio Total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                IconColumn::make('estado')
                    ->label('Estado')
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
                //TrashedFilter::make(),
            ])
            ->recordActions([
                CreateAction::make(),
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
