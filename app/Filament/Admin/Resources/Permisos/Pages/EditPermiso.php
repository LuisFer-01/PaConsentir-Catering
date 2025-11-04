<?php

namespace App\Filament\Admin\Resources\Permisos\Pages;

use App\Filament\Admin\Resources\Permisos\PermisoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPermiso extends EditRecord
{
    protected static string $resource = PermisoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
