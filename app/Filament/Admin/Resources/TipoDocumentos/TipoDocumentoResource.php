<?php

namespace App\Filament\Admin\Resources\TipoDocumentos;

use App\Filament\Admin\Resources\TipoDocumentos\Pages\CreateTipoDocumento;
use App\Filament\Admin\Resources\TipoDocumentos\Pages\EditTipoDocumento;
use App\Filament\Admin\Resources\TipoDocumentos\Pages\ListTipoDocumentos;
use App\Filament\Admin\Resources\TipoDocumentos\Pages\ViewTipoDocumento;
use App\Filament\Admin\Resources\TipoDocumentos\Schemas\TipoDocumentoForm;
use App\Filament\Admin\Resources\TipoDocumentos\Schemas\TipoDocumentoInfolist;
use App\Filament\Admin\Resources\TipoDocumentos\Tables\TipoDocumentosTable;
use App\Models\TipoDocumento;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Traits\AuthorizesWithPermission;

class TipoDocumentoResource extends Resource
{
    use AuthorizesWithPermission;
    protected static ?string $model = TipoDocumento::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Tipo Documento';

    public static function form(Schema $schema): Schema
    {
        return TipoDocumentoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TipoDocumentoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TipoDocumentosTable::configure($table);
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
            'index' => ListTipoDocumentos::route('/'),
            'create' => CreateTipoDocumento::route('/create'),
            'view' => ViewTipoDocumento::route('/{record}'),
            'edit' => EditTipoDocumento::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'PARÁMETROS';
    }
}
