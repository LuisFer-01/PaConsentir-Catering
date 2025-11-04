<?php

namespace App\Filament\Admin\Resources\Permisos\Pages;

use App\Filament\Admin\Resources\Permisos\PermisoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPermiso extends ViewRecord
{
    protected static string $resource = PermisoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
