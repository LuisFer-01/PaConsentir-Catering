<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompra extends EditRecord
{
    protected static string $resource = CompraResource::class;
    protected function calculateTotalPrec(): float
    {
        $detalles = $this->data['detalles'] ?? [];

        return collect($detalles)->sum(fn ($item) => 
            ($item['cantidad'] ?? 0) * ($item['precio_unitario'] ?? 0)
        );
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['totalprec'] = $this->calculateTotalPrec();
        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Venta actualizada correctamente!';
    }
}
