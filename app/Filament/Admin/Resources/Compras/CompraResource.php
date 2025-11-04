<?php

namespace App\Filament\Admin\Resources\Compras;

use App\Filament\Admin\Resources\Compras\Pages\ManageCompras;
use App\Models\Compra;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompraResource extends Resource
{
    protected static ?string $model = Compra::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Compra';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('proveedor_id')
                    ->numeric(),
                TextInput::make('usuario_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tipodocumento_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tipopago_id')
                    ->required()
                    ->numeric(),
                TextInput::make('totalcost')
                    ->required()
                    ->numeric(),
                DatePicker::make('fecha')
                    ->required(),
                Toggle::make('estado')
                    ->required(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('proveedor_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('usuario_id')
                    ->numeric(),
                TextEntry::make('tipodocumento_id')
                    ->numeric(),
                TextEntry::make('tipopago_id')
                    ->numeric(),
                TextEntry::make('totalcost')
                    ->numeric(),
                TextEntry::make('fecha')
                    ->date(),
                IconEntry::make('estado')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Compra')
            ->columns([
                TextColumn::make('proveedor_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('usuario_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipodocumento_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipopago_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('totalcost')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                IconColumn::make('estado')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCompras::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'COMPRA';
    }
}
