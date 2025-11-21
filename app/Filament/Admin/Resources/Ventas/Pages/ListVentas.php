<?php

namespace App\Filament\Admin\Resources\Ventas\Pages;

use App\Filament\Admin\Resources\Ventas\VentaResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
//use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class ListVentas extends ListRecords
{
    protected static string $resource = VentaResource::class;

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
                TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('usuario.name')
                    ->label('Registrado por')
                    ->sortable(),

                TextColumn::make('fecha')
                    ->date('d M Y')
                    ->label('Fecha')
                    ->sortable(),

                TextColumn::make('totalprec')
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
                // Actions\EditAction::make(), // ← Comentado porque NO quieres editar ventas
                Action::make('pdf')
                    ->label('Factura PDF')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->url(fn ($record) => route('venta.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                // Opcional: eliminar varias
            ])
            ->emptyStateHeading('No hay ventas registradas')
            ->emptyStateDescription('Haz clic en "Nueva venta" para registrar la primera.')
            ->striped();
    }
}
