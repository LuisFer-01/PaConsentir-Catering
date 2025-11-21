<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompra extends EditRecord
{
    protected static string $resource = CompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $total = collect($data['detalles'] ?? [])->sum('subtotal');
        $data['totalcost'] = $total;

        return $data;
    }
}
