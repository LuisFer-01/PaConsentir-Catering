<?php

namespace App\Filament\Admin\Resources\Menus;

use App\Filament\Admin\Resources\Menus\Pages\CreateMenu;
use App\Filament\Admin\Resources\Menus\Pages\EditMenu;
use App\Filament\Admin\Resources\Menus\Pages\ListMenus;
use App\Filament\Admin\Resources\Menus\Pages\ViewMenu;
use App\Filament\Admin\Resources\Menus\Schemas\MenuForm;
use App\Filament\Admin\Resources\Menus\Schemas\MenuInfolist;
use App\Filament\Admin\Resources\Menus\Tables\MenusTable;
use App\Models\Menu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Traits\AuthorizesWithPermission;

class MenuResource extends Resource
{
    use AuthorizesWithPermission;
    protected static ?string $model = Menu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ReceiptPercent;

    public static function getNavigationLabel(): string
    {
        return 'Gestionar Menu';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Gestionar Menus';
    }

    public static function getModelLabel(): string
    {
        return 'Menu';
    }

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return MenuForm::configure($schema);
    }

    public static function infolist(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return MenuInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenusTable::configure($table);
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
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
            'view' => ViewMenu::route('/{record}'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'PARÁMETROS';
    }
}
