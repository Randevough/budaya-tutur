<?php

namespace App\Filament\Resources\Regencies;

use App\Filament\Resources\Regencies\Pages\CreateRegency;
use App\Filament\Resources\Regencies\Pages\EditRegency;
use App\Filament\Resources\Regencies\Pages\ListRegencies;
use App\Filament\Resources\Regencies\Schemas\RegencyForm;
use App\Filament\Resources\Regencies\Tables\RegenciesTable;
use App\Models\Regency;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RegencyResource extends Resource
{
    protected static ?string $model = Regency::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static UnitEnum|string|null $navigationGroup = 'Wilayah & Geografis';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Kabupaten / Kota';

    protected static ?string $pluralModelLabel = 'Kabupaten & Kota';

    public static function getNavigationBadge(): ?string
    {
        return \Illuminate\Support\Facades\Cache::remember('regencies_count', 86400, fn () => (string) Regency::count());
    }

    public static function form(Schema $schema): Schema
    {
        return RegencyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegenciesTable::configure($table);
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
            'index' => ListRegencies::route('/'),
            'create' => CreateRegency::route('/create'),
            'edit' => EditRegency::route('/{record}/edit'),
        ];
    }
}
