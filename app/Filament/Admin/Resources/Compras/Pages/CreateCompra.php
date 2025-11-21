<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CreateCompra extends CreateRecord
{
    protected static string $resource = CompraResource::class;
    // Se ejecuta al cargar el formulario
    public function mount(): void
    {
        $this->form->fill([
            'fecha' => now()->format('Y-m-d'),
            'usuario_id' => auth()->id(),
            'totalcost' => 0,
        ]);
    }

    // Calcula el total de los detalles
    protected function calculateTotalCost(): float
    {
        $detalles = $this->data['detalles'] ?? [];

        return collect($detalles)->sum(function ($item) {
            return ($item['cantidad'] ?? 0) * ($item['precio_unitario'] ?? 0);
        });
    }

    // Se ejecuta ANTES de crear el registro
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Calcular totalcost correctamente
        $data['totalcost'] = $this->calculateTotalCost();

        // Forzar usuario autenticado
        $data['usuario_id'] = auth()->id();

        // Asegurar estado activo por defecto
        $data['estado'] = $data['estado'] ?? 1;

        return $data;
    }

    // Se ejecuta después de crear (opcional: redirección o mensaje)
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Mensaje de éxito personalizado
    protected function getCreatedNotificationTitle(): ?string
    {
        return '¡Compra creada exitosamente!';
    }
}
