<?php

namespace App\Filament\Admin\Resources\Platos\Pages;

use App\Filament\Admin\Resources\Platos\PlatoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlatos extends ListRecords
{
    protected static string $resource = PlatoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
