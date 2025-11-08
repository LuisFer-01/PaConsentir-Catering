<?php

namespace App\Filament\Admin\Resources\Proveedors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProveedorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('contacto')
                    ->label('Contacto')
                    ->searchable(),
                TextColumn::make('telefono')
                    ->label('Telefono')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                TextColumn::make('direccion')
                    ->label('Direccion')
                    ->searchable(),
                IconColumn::make('estado')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
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
                SelectFilter::make('estado')
                    ->label('Filtrar por estado')
                    ->options([
                        ''  => 'Todos',
                        '1' => 'Activos',
                        '0' => 'Inactivos',
                    ])
                    ->query(function ($query, $state) {
                        if ($state['value'] === '' || $state['value'] === null) {
                            return $query; // Mostrar todos
                        }
                        return $query->where('estado', $state['value']);
                    })
                    ->default(''),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),

                // Acción individual: Activar
                /*\Filament\Actions\Action::make('activar')
                    ->label('Activar')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->estado == 0)
                    ->action(fn ($record) => $record->update(['estado' => 1]))
                    ->requiresConfirmation(),

                // Acción individual: Desactivar
                \Filament\Actions\Action::make('desactivar')
                    ->label('Desactivar')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->estado == 1)
                    ->action(fn ($record) => $record->update(['estado' => 0]))
                    ->requiresConfirmation(),*/
            ])
            ->bulkActions([
                // Acción masiva: Activar
                \Filament\Actions\BulkAction::make('activar')
                    ->label('Activar seleccionados')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn ($records) => $records->each->update(['estado' => 1]))
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion(),

                // Acción masiva: Desactivar
                \Filament\Actions\BulkAction::make('desactivar')
                    ->label('Desactivar seleccionados')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn ($records) => $records->each->update(['estado' => 0]))
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion(),
            ])
            ->emptyStateHeading('No hay roles')
            ->emptyStateDescription('Crea el primer rol para comenzar.')
            ->striped();
    }
}
