<?php

namespace App\Filament\Admin\Resources\Platos\Pages;

use App\Filament\Admin\Resources\Platos\PlatoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPlato extends EditRecord
{
    protected static string $resource = PlatoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->label('Desactivar')
                ->icon('heroicon-o-trash')
                ->action(fn ($record) => $record->update(['estado' => 0])),
        ];
    }
}
