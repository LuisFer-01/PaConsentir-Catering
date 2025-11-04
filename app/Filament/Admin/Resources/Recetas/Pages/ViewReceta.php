<?php

namespace App\Filament\Admin\Resources\Recetas\Pages;

use App\Filament\Admin\Resources\Recetas\RecetaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReceta extends ViewRecord
{
    protected static string $resource = RecetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
