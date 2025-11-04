<?php

namespace App\Filament\Admin\Resources\TipoPagos\Pages;

use App\Filament\Admin\Resources\TipoPagos\TipoPagoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTipoPago extends EditRecord
{
    protected static string $resource = TipoPagoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
