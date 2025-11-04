<?php

namespace App\Filament\Admin\Resources\Rols\Pages;

use App\Filament\Admin\Resources\Rols\RolResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRol extends CreateRecord
{
    protected static string $resource = RolResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1; // Siempre activo al crear
        return $data;
    }
}
