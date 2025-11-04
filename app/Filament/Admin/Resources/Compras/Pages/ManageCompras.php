<?php

namespace App\Filament\Admin\Resources\Compras\Pages;

use App\Filament\Admin\Resources\Compras\CompraResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCompras extends ManageRecords
{
    protected static string $resource = CompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
