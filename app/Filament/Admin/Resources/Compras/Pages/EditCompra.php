<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompra extends EditRecord
{
    protected static string $resource = CompraResource::class;
    protected function calculateTotalCost(): float
    {
        $detalles = $this->data['detalles'] ?? [];

        return collect($detalles)->sum(function ($item) {
            return ($item['cantidad'] ?? 0) * ($item['precio_unitario'] ?? 0);
        });
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['totalcost'] = $this->calculateTotalCost();
        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return '¡Compra actualizada correctamente!';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
