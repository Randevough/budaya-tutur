<?php

namespace App\Filament\Resources\Provinces\Schemas;

use App\Models\Province;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class ProvinceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Provinsi')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, ?string $state, callable $set) {
                        if ($operation === 'create' && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    }),

                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->unique(Province::class, 'slug', ignoreRecord: true)
                    ->suffixAction(
                        Action::make('generateSlug')
                            ->icon(Heroicon::OutlinedArrowPath)
                            ->tooltip('Hasilkan ulang slug dari nama')
                            ->action(function (callable $get, callable $set) {
                                $name = $get('name');
                                if (filled($name)) {
                                    $set('slug', Str::slug($name));
                                }
                            })
                    ),
            ]);
    }
}
