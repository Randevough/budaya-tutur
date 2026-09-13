<?php

namespace App\Filament\Resources\CultureItems\Pages;

use App\Filament\Resources\CultureItems\CultureItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCultureItem extends EditRecord
{
    protected static string $resource = CultureItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
