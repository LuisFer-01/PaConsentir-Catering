<?php

namespace App\Filament\Admin\Resources\TipoDocumentos\Pages;

use App\Filament\Admin\Resources\TipoDocumentos\TipoDocumentoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTipoDocumento extends ViewRecord
{
    protected static string $resource = TipoDocumentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
