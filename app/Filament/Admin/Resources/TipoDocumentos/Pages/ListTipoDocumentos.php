<?php

namespace App\Filament\Admin\Resources\TipoDocumentos\Pages;

use App\Filament\Admin\Resources\TipoDocumentos\TipoDocumentoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTipoDocumentos extends ListRecords
{
    protected static string $resource = TipoDocumentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
