<?php

namespace App\Filament\Resources\CultureItems;

use App\Filament\Resources\CultureItems\Pages\CreateCultureItem;
use App\Filament\Resources\CultureItems\Pages\EditCultureItem;
use App\Filament\Resources\CultureItems\Pages\ListCultureItems;
use App\Filament\Resources\CultureItems\Schemas\CultureItemForm;
use App\Filament\Resources\CultureItems\Tables\CultureItemsTable;
use App\Models\CultureItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CultureItemResource extends Resource
{
    protected static ?string $model = CultureItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CultureItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CultureItemsTable::configure($table);
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
            'index' => ListCultureItems::route('/'),
            'create' => CreateCultureItem::route('/create'),
            'edit' => EditCultureItem::route('/{record}/edit'),
        ];
    }
}
