<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CultureItems\CultureItemResource;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
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
        $isDonationActive = (bool) SiteSetting::current()->is_donation_active;

        return [
            Action::make('toggle_donation')
                ->label($isDonationActive ? 'Donasi: Aktif' : 'Donasi: Nonaktif')
                ->tooltip('Klik untuk mengubah status aktif laman donasi publik (/donasi)')
                ->icon($isDonationActive ? Heroicon::OutlinedCheckCircle : Heroicon::OutlinedXCircle)
                ->color($isDonationActive ? 'success' : 'gray')
                ->outlined()
                ->action(function () {
                    $setting = SiteSetting::find(1) ?? SiteSetting::firstOrCreate(['id' => 1]);
                    $setting->is_donation_active = ! $setting->is_donation_active;
                    $setting->save();

                    Notification::make()
                        ->title($setting->is_donation_active ? 'Halaman Donasi Diaktifkan' : 'Halaman Donasi Dinonaktifkan')
                        ->body($setting->is_donation_active
                            ? 'Halaman donasi publik kini aktif di /donasi.'
                            : 'Halaman donasi publik dinonaktifkan (404).')
                        ->color($setting->is_donation_active ? 'success' : 'gray')
                        ->send();
                }),

            Action::make('create_culture_item')
                ->label('Catat Tuturan Baru')
                ->icon(Heroicon::OutlinedPlus)
                ->url(CultureItemResource::getUrl('create'))
                ->color('primary'),
        ];
    }
}
