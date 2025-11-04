<?php

namespace App\Filament\Admin\Resources\TipoPagos\Pages;

use App\Filament\Admin\Resources\TipoPagos\TipoPagoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTipoPago extends ViewRecord
{
    protected static string $resource = TipoPagoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
