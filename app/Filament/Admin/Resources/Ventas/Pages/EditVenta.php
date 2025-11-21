<?php

namespace App\Filament\Admin\Resources\Ventas\Pages;

use App\Filament\Admin\Resources\Ventas\VentaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVenta extends EditRecord
{
    protected static string $resource = VentaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['totalprec'] = collect($data['detalles'] ?? [])->sum('subtotal');
        $data['usuario_id'] = auth()->id();
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['totalprec'] = collect($data['detalles'] ?? [])->sum('subtotal');
        return $data;
    }
}
