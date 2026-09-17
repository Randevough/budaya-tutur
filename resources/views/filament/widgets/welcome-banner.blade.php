@php
    use Filament\Support\Icons\Heroicon;

    $user = filament()->auth()->user();
    $userName = filament()->getUserName($user);
    $createUrl = \App\Filament\Resources\CultureItems\CultureItemResource::getUrl('create');
    $currentDate = \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y');
@endphp

<x-filament-widgets::widget class="fi-welcome-banner-widget">
    <x-filament::section>
        <div class="bt-welcome-container">
            <div class="bt-welcome-left">
                <div class="bt-welcome-avatar">
                    {{ strtoupper(substr($userName, 0, 2)) }}
                </div>
                <div class="bt-welcome-info">
                    <div class="bt-welcome-meta">
                        <span class="bt-meta-badge">
                            <span class="bt-meta-dot"></span>
                            Panel Kurasi
                        </span>
                        <span class="bt-meta-sep">•</span>
                        <span>{{ $currentDate }}</span>
                    </div>
                    <h2 class="bt-welcome-heading">
                        Selamat datang kembali, <span class="bt-welcome-name">{{ $userName }}</span>
                    </h2>
                    <p class="bt-welcome-desc">
                        Sistem manajemen dan pengarsipan warisan tutur lisan nusantara.
                    </p>
                </div>
            </div>

            <div class="bt-welcome-actions">
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
