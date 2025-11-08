<?php

namespace App\Filament\Admin\Resources\TipoPagos;

use App\Filament\Admin\Resources\TipoPagos\Pages\CreateTipoPago;
use App\Filament\Admin\Resources\TipoPagos\Pages\EditTipoPago;
use App\Filament\Admin\Resources\TipoPagos\Pages\ListTipoPagos;
use App\Filament\Admin\Resources\TipoPagos\Pages\ViewTipoPago;
use App\Filament\Admin\Resources\TipoPagos\Schemas\TipoPagoForm;
use App\Filament\Admin\Resources\TipoPagos\Schemas\TipoPagoInfolist;
use App\Filament\Admin\Resources\TipoPagos\Tables\TipoPagosTable;
use App\Models\TipoPago;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Traits\AuthorizesWithPermission;

class TipoPagoResource extends Resource
{
    use AuthorizesWithPermission;
    protected static ?string $model = TipoPago::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationLabel(): string
    {
        return 'Gestionar Tipo Pago';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Gestionar Tipo Pagos';
    }

    public static function getModelLabel(): string
    {
        return 'Tipo Pago';
    }

    public static function form(Schema $schema): Schema
    {
        return TipoPagoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TipoPagoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TipoPagosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTipoPagos::route('/'),
            'create' => CreateTipoPago::route('/create'),
            'view' => ViewTipoPago::route('/{record}'),
            'edit' => EditTipoPago::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'PARÁMETROS';
    }
}
