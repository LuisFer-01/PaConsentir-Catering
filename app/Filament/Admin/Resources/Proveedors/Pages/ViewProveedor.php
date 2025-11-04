<?php

namespace App\Filament\Admin\Resources\Proveedors\Pages;

use App\Filament\Admin\Resources\Proveedors\ProveedorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProveedor extends ViewRecord
{
    protected static string $resource = ProveedorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
