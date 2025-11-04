<?php

namespace App\Filament\Admin\Resources\UndMedidas\Pages;

use App\Filament\Admin\Resources\UndMedidas\UndMedidaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUndMedida extends EditRecord
{
    protected static string $resource = UndMedidaResource::class;

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
