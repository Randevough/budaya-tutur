<?php

namespace App\Filament\Resources\CultureItems\Pages;

use App\Filament\Resources\CultureItems\CultureItemResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateCultureItem extends CreateRecord
{
    protected static string $resource = CultureItemResource::class;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }
}
