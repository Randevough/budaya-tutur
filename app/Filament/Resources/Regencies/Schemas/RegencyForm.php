<?php

namespace App\Filament\Resources\Regencies\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RegencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->relationship('province', 'name')
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Kabupaten / Kota')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(\App\Models\Regency::class, 'slug', ignoreRecord: true),
                TextInput::make('latitude')
                    ->label('Latitude Centroid')
                    ->helperText('Koordinat garis lintang titik tengah kabupaten/kota untuk marker peta (contoh: -8.3134900)')
                    ->required()
                    ->numeric(),
                TextInput::make('longitude')
                    ->label('Longitude Centroid')
                    ->helperText('Koordinat garis bujur titik tengah kabupaten/kota untuk marker peta (contoh: 124.6468400)')
                    ->required()
                    ->numeric(),
            ]);
    }
}
