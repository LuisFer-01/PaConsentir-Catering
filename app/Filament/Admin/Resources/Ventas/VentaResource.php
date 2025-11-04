<?php

namespace App\Filament\Admin\Resources\Ventas;

use App\Filament\Admin\Resources\Ventas\Pages\ManageVentas;
use App\Models\Venta;
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

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Venta';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('cliente_id')
                    ->numeric(),
                TextInput::make('usuario_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tipodocumento_id')
                    ->required()
                    ->numeric(),
                TextInput::make('totalprec')
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
                TextEntry::make('cliente_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('usuario_id')
                    ->numeric(),
                TextEntry::make('tipodocumento_id')
                    ->numeric(),
                TextEntry::make('totalprec')
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
            ->recordTitleAttribute('Venta')
            ->columns([
                TextColumn::make('cliente_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('usuario_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipodocumento_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('totalprec')
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
            'index' => ManageVentas::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'VENTA';
    }
}
