<?php

namespace App\Filament\Widgets;

use App\Models\SiteSetting;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class WelcomeBannerWidget extends Widget
{
    protected static ?int $sort = -3;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.widgets.welcome-banner';

    public bool $isDonationActive = false;

    public function mount(): void
    {
        $this->isDonationActive = (bool) SiteSetting::current()->is_donation_active;
    }

    public function toggleDonation(): void
    {
        $setting = SiteSetting::find(1) ?? SiteSetting::firstOrCreate(['id' => 1]);
        $setting->is_donation_active = ! $setting->is_donation_active;
        $setting->save();

        $this->isDonationActive = (bool) $setting->is_donation_active;

        Notification::make()
            ->title($this->isDonationActive ? 'Halaman Donasi Diaktifkan' : 'Halaman Donasi Dinonaktifkan')
            ->body($this->isDonationActive
                ? 'Halaman donasi publik kini dapat diakses di /donasi.'
                : 'Halaman donasi publik dinonaktifkan (404).')
            ->color($this->isDonationActive ? 'success' : 'gray')
            ->send();
    }

    public static function canView(): bool
    {
        return Filament::auth()->check();
    }
}
