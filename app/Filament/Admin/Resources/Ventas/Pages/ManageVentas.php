<?php

namespace App\Filament\Admin\Resources\Ventas\Pages;

use App\Filament\Admin\Resources\Ventas\VentaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageVentas extends ManageRecords
{
    protected static string $resource = VentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
