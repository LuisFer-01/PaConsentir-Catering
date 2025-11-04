<?php

namespace App\Filament\Admin\Resources\TipoPagos\Pages;

use App\Filament\Admin\Resources\TipoPagos\TipoPagoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTipoPagos extends ListRecords
{
    protected static string $resource = TipoPagoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
