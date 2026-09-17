@php
    use App\Filament\Resources\CultureItems\CultureItemResource;
    use App\Filament\Resources\SiteSettings\SiteSettingResource;
    use Filament\Support\Icons\Heroicon;

    $user = filament()->auth()->user();
    $userName = filament()->getUserName($user);
    $createUrl = rescue(fn () => CultureItemResource::getUrl('create'), url('/admin/culture-items/create'));
    $settingsUrl = rescue(fn () => SiteSettingResource::getUrl(), url('/admin/site-settings'));
@endphp

<x-filament-widgets::widget class="fi-welcome-banner-widget">
    <x-filament::section>
        <div class="bt-welcome-container">
            <div class="bt-welcome-left">
                <div class="bt-welcome-avatar">
                    {{ strtoupper(substr($userName, 0, 2)) }}
                </div>
                <div class="bt-welcome-info">
                    <h2 class="bt-welcome-heading">
                        Selamat datang kembali, <span class="bt-welcome-name">{{ $userName }}</span>
                    </h2>
                    <p class="bt-welcome-desc">
                        Sistem manajemen dan pengarsipan warisan tutur lisan nusantara.
                    </p>
                </div>
            </div>

            <div class="bt-welcome-actions">
                <div class="bt-donation-quick-ctrl">
                    <button
                        type="button"
                        wire:click="toggleDonation"
                        wire:loading.attr="disabled"
                        class="bt-donation-toggle-btn {{ $this->isDonationActive ? 'is-active' : 'is-inactive' }}"
                        title="Klik untuk mengubah status aktif halaman donasi publik"
                    >
                        <span class="bt-donation-status-dot"></span>
                        <span class="bt-donation-status-label">
                            Donasi: <strong>{{ $this->isDonationActive ? 'Aktif' : 'Nonaktif' }}</strong>
                        </span>
                    </button>
                    <a
                        href="{{ $settingsUrl }}"
                        class="bt-donation-manage-link"
                        title="Atur nomor rekening, QRIS, dan WhatsApp"
                    >
                        Kelola Rekening &rarr;
                    </a>
                </div>

                <x-filament::button
                    tag="a"
                    :href="$createUrl"
                    :icon="Heroicon::Plus"
                    color="primary"
                >
                    Catat Tuturan Baru
                </x-filament::button>

                <x-filament::button
                    tag="a"
                    :href="url('/')"
                    target="_blank"
                    :icon="Heroicon::ArrowTopRightOnSquare"
                    color="gray"
                >
                    Lihat Website
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
