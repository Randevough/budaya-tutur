<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CultureItems\CultureItemResource;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    public function getSubheading(): ?string
    {
        return 'Ringkasan kurasi dan status arsip digital warisan tutur nusantara.';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create_culture_item')
                ->label('Catat Tuturan Baru')
                ->icon(Heroicon::OutlinedPlus)
                ->url(CultureItemResource::getUrl('create'))
                ->color('primary'),
        ];
    }
}
