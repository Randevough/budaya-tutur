<?php

namespace App\Filament\Resources\CultureItems\Pages;

use App\Filament\Resources\CultureItems\CultureItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCultureItems extends ListRecords
{
    protected static string $resource = CultureItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
