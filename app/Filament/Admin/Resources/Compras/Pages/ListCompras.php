<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class ListCompras extends ListRecords
{
    protected static string $resource = CompraResource::class;
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('proveedor.nombre')->label('Proveedor')->searchable(),
                TextColumn::make('usuario.name')->label('Registrado por'),
                TextColumn::make('fecha')->date(),
                TextColumn::make('totalcost')->money('USD')->sortable(),
                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors(['success' => 1, 'danger' => 0])
                    ->formatStateUsing(fn ($state) => $state ? 'Completada' : 'Cancelada'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
