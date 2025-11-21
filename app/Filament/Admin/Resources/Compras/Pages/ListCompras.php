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
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('proveedor.nombre')
                    ->label('Proveedor')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('usuario.name')
                    ->label('Registrado por')
                    ->sortable(),

                TextColumn::make('fecha')
                    ->date('d M Y')
                    ->label('Fecha')
                    ->sortable(),

                TextColumn::make('totalcost')
                    ->money('USD')
                    ->label('Total')
                    ->sortable()
                    ->alignEnd(),

                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'success' => 1,
                        'danger' => 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Completada' : 'Cancelada')
                    ->icons([
                        'heroicon-o-check-circle' => 1,
                        'heroicon-o-x-circle' => 0,
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                // Actions\EditAction::make(), // ← Comentado porque NO quieres editar compras
            ])
            ->bulkActions([
                // Opcional: eliminar varias
            ])
            ->emptyStateHeading('No hay compras registradas')
            ->emptyStateDescription('Haz clic en "Nueva Compra" para registrar la primera.')
            ->striped();
    }
}
