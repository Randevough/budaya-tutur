<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalItems = CultureItem::count();
        $publishedItems = CultureItem::where('is_published', true)->count();
        $draftItems = $totalItems - $publishedItems;

        $regenciesWithContent = Regency::whereHas('cultureItems')->count();
        $totalRegencies = Regency::count();

        $provincesCount = Province::count();

        $totalMessages = ContactMessage::count();
        $unsentMessages = ContactMessage::where('is_sent_via_smtp', false)->count();

        return [
            Stat::make('Arsip Budaya Tutur', (string) $totalItems)
                ->description("{$publishedItems} terbit publik" . ($draftItems > 0 ? ", {$draftItems} draf" : ''))
                ->color('gray'),

            Stat::make('Wilayah Terekam', "{$regenciesWithContent} / {$totalRegencies}")
                ->description('Kabupaten/Kota aktif di peta')
                ->color('gray'),

            Stat::make('Cakupan Provinsi', (string) $provincesCount)
                ->description('Provinsi induk terdaftar')
                ->color('gray'),

            Stat::make('Pesan Kontak', (string) $totalMessages)
                ->description($unsentMessages > 0 ? "{$unsentMessages} pesan di database" : 'Semua pesan terkirim')
                ->color($unsentMessages > 0 ? 'warning' : 'gray'),
        ];
    }
}
