<?php

namespace App\Filament\Admin\Resources\Ventas\Pages;

use App\Filament\Admin\Resources\Ventas\VentaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;
    public function mount(): void
    {
        $this->form->fill([
            'fecha' => now()->format('Y-m-d'),
            'usuario_id' => auth()->id(),
            'totalprec' => 0,
        ]);
    }

    // Calcula el total de los detalles
    protected function calculateTotalPrec(): float
    {
        $detalles = $this->data['detalles'] ?? [];

        return collect($detalles)->sum(function ($item) {
            return ($item['cantidad'] ?? 0) * ($item['precio_unitario'] ?? 0);
        });
    }

    // ANTES DE GUARDAR → forzamos el cálculo
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['totalprec'] = $this->calculateTotalPrec(); // ← ESTO ES LA CLAVE
        $data['usuario_id'] = auth()->id();
        $data['estado'] = 1; // completada

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return '¡Venta creada exitosamente! Total: Bs ' . number_format($this->calculateTotalPrec(), 2);
    }
}
