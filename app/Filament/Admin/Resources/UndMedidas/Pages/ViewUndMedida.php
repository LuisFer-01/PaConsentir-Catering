<?php

namespace App\Filament\Admin\Resources\UndMedidas\Pages;

use App\Filament\Admin\Resources\UndMedidas\UndMedidaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUndMedida extends ViewRecord
{
    protected static string $resource = UndMedidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
