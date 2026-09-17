<?php

namespace App\Filament\Resources\CultureItems\Pages;

use App\Filament\Resources\CultureItems\CultureItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListCultureItems extends ListRecords
{
    protected static string $resource = CultureItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Arsip Budaya')
                ->icon(Heroicon::OutlinedPlus),
        ];
    }
}
