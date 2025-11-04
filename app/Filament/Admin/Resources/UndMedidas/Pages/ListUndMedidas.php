<?php

namespace App\Filament\Admin\Resources\UndMedidas\Pages;

use App\Filament\Admin\Resources\UndMedidas\UndMedidaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUndMedidas extends ListRecords
{
    protected static string $resource = UndMedidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
