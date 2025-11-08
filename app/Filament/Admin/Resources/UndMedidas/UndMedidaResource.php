<?php

namespace App\Filament\Admin\Resources\UndMedidas;

use App\Filament\Admin\Resources\UndMedidas\Pages\CreateUndMedida;
use App\Filament\Admin\Resources\UndMedidas\Pages\EditUndMedida;
use App\Filament\Admin\Resources\UndMedidas\Pages\ListUndMedidas;
use App\Filament\Admin\Resources\UndMedidas\Pages\ViewUndMedida;
use App\Filament\Admin\Resources\UndMedidas\Schemas\UndMedidaForm;
use App\Filament\Admin\Resources\UndMedidas\Schemas\UndMedidaInfolist;
use App\Filament\Admin\Resources\UndMedidas\Tables\UndMedidasTable;
use App\Models\UndMedida;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Traits\AuthorizesWithPermission;

class UndMedidaResource extends Resource
{
    use AuthorizesWithPermission;
    protected static ?string $model = UndMedida::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Unidad Medida';

    public static function form(Schema $schema): Schema
    {
        return UndMedidaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UndMedidaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UndMedidasTable::configure($table);
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
            'index' => ListUndMedidas::route('/'),
            'create' => CreateUndMedida::route('/create'),
            'view' => ViewUndMedida::route('/{record}'),
            'edit' => EditUndMedida::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'PARÁMETROS';
    }
}
