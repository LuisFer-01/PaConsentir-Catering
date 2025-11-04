<?php

namespace App\Filament\Admin\Resources\Categorias\Pages;

use App\Filament\Admin\Resources\Categorias\CategoriaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoria extends ViewRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
