<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompra extends ViewRecord
{
    protected static string $resource = CompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
