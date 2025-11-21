<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Tabs;

class CreateCompra extends CreateRecord
{
    protected static string $resource = CompraResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Calculamos el total a partir de los detalles
        $total = collect($data['detalles'] ?? [])->sum('subtotal');

        $data['totalcost'] = $total;
        $data['usuario_id'] = auth()->id();

        return $data;
    }
}
