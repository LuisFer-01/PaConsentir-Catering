<?php

namespace App\Filament\Admin\Resources\Rols\Pages;

use App\Filament\Admin\Resources\Rols\RolResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRols extends ListRecords
{
    protected static string $resource = RolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getTableQuery()->where('estado', 1);
    }
}
