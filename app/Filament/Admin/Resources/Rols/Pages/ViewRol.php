<?php

namespace App\Filament\Admin\Resources\Rols\Pages;

use App\Filament\Admin\Resources\Rols\RolResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRol extends ViewRecord
{
    protected static string $resource = RolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
