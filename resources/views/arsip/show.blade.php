@extends('layouts.app')

@section('title', $item->title . ' : Budaya Tutur')
@section('meta_description', Str::limit(strip_tags($item->excerpt ?? $item->description), 160))
@section('og_title', $item->title . ' : ' . $item->regency->name)
@section('og_description', Str::limit(strip_tags($item->excerpt ?? $item->description), 160))
@section('og_image', $item->thumbnail_url)

@push('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AudioObject",
    "name": "{{ addslashes($item->title) }}",
    "description": "{{ addslashes(Str::limit(strip_tags($item->excerpt ?? $item->description), 200)) }}",
    "contentUrl": "https://www.youtube.com/watch?v={{ $item->youtube_id }}",
    "embedUrl": "https://www.youtube-nocookie.com/embed/{{ $item->youtube_id }}",
    "thumbnailUrl": "{{ $item->thumbnail_url }}",
    "uploadDate": "{{ $item->created_at ? $item->created_at->toIso8601String() : now()->toIso8601String() }}",
    "inLanguage": "id",
    "contentLocation": {
        "@type": "Place",
        "name": "{{ addslashes($item->regency->name) }}, {{ addslashes($item->regency->province->name) }}"
    }
}
</script>
@endpush

@section('content')
    <!-- 1. FULL VIEWPORT THEATER HERO [DARK: Responsive Proportional Layout] -->
    <header class="h-auto min-h-0 lg:h-[calc(100vh-5rem)] lg:max-h-[calc(100vh-5rem)] flex flex-col pt-6 sm:pt-8 pb-8 lg:pb-8 bg-obsidian-900 text-ink-100 border-b border-obsidian-700 relative overflow-hidden">
        <!-- Top Utility Bar: Back to Archive & Region (Restored) -->
        <div class="max-w-5xl mx-auto px-4 sm:px-8 w-full flex-shrink-0 mb-4 lg:mb-0">
            <div class="flex items-center justify-between text-xs uppercase tracking-[0.2em] text-ink-400">
                <a href="{{ route('arsip.index') }}" class="inline-flex items-center space-x-2 text-xs uppercase tracking-[0.2em] text-ink-400 hover:text-ink-100 transition-colors group min-h-[44px]">
                    <span class="transition-transform duration-200 group-hover:-translate-x-1">&larr;</span>
                    <span>Kembali ke Katalog</span>
                </a>

                <div class="text-xs uppercase tracking-[0.2em] text-ink-400 font-medium">
                    {{ $item->regency->name }} &bull; {{ $item->regency->province->name }}
                </div>
            </div>
        </div>

        <!-- Center Stage: Title + Media Player unified as ONE vertically centered composite unit -->
        <div class="flex-1 min-h-0 flex flex-col items-center justify-center max-w-5xl mx-auto px-4 sm:px-8 w-full">
            <div class="w-full flex flex-col items-center my-auto">
                <!-- Proportional Editorial Title in Mencken Std Head, snug directly above player -->
                <h1 class="font-serif text-lg sm:text-2xl md:text-3xl font-bold tracking-[0.03em] uppercase text-ink-100 text-center leading-snug max-w-3xl mx-auto mb-4 sm:mb-5 flex-shrink-0" style="font-family: 'Mencken Std Head', 'Cinzel', Georgia, serif;">
                    {{ $item->title }}
                </h1>

                <!-- YouTube Lite Media Theater Container (Snug to Title) -->
                <div class="w-full aspect-video max-w-xl sm:max-w-2xl lg:max-w-3xl max-h-[290px] sm:max-h-[330px] md:max-h-[350px] mx-auto border border-obsidian-700 bg-black overflow-hidden shadow-2xl relative flex items-center justify-center">
                    <div id="lite-player-container" 
                         role="button"
                         tabindex="0"
                         aria-label="Putar rekaman tuturan: {{ $item->title }}"
                         class="relative w-full h-full bg-obsidian-950 flex items-center justify-center cursor-pointer group focus:outline-none focus-visible:ring-2 focus-visible:ring-ink-100"
                         data-youtube-id="{{ $item->youtube_id }}">
                        
                        <!-- Static Grayscale Thumbnail -->
                        <img id="lite-player-thumb"
                             src="{{ $item->thumbnail_url }}" 
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover grayscale contrast-110 group-hover:scale-105 transition-all duration-700 ease-out"
                             onerror="this.src='https://img.youtube.com/vi/{{ $item->youtube_id }}/hqdefault.jpg'">
                        
                        <!-- Dark Gradient Vignette -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-black/35 group-hover:opacity-80 transition-opacity"></div>

                        <!-- Custom Play Button Overlay -->
                        <div id="lite-player-button" class="absolute z-10 flex flex-col items-center justify-center space-y-2 pointer-events-none">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full border border-ink-100/40 bg-ink-100/15 backdrop-blur-md flex items-center justify-center text-ink-100 group-hover:scale-110 group-hover:bg-ink-100 group-hover:text-obsidian-950 transition-all duration-300 shadow-2xl">
                                <svg class="w-5 h-5 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                            <span class="text-xs uppercase tracking-[0.2em] text-ink-200 group-hover:text-ink-100 font-medium">
                                Dengarkan Tuturan
                            </span>
                        </div>

                        <!-- Notice Badge Inside Player -->
                        <div class="absolute bottom-3 left-4 text-xs uppercase tracking-wider text-ink-300 bg-obsidian-950/80 px-2.5 py-1 backdrop-blur-sm border border-obsidian-700/80">
                            Rekaman Audio & Visual Lapangan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. NARRATIVE & SIDEBAR SECTION [LIGHT: Unbleached Linen #F8F5F0 with Sticky Metadata] -->
    <article id="narasi-section" class="py-12 sm:py-16 bg-linen-100 text-ink-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14">
                <!-- Main Narrative & Transcription (8 cols) -->
                <div class="lg:col-span-8 space-y-8">
                    <h2 class="font-serif text-xl sm:text-2xl font-bold uppercase tracking-tight text-ink-900 border-b border-linen-300 pb-4">
                        Konteks Kultural & Narasi Tuturan
                    </h2>

                    <!-- Editorial Body Text -->
                    <div class="text-ink-700 text-sm sm:text-base leading-relaxed space-y-6 font-light">
                        {!! nl2br(e($item->description)) !!}
                    </div>

                    <!-- Archival Notice Box -->
                    <div class="p-6 border border-linen-300 bg-linen-200/80 text-xs text-ink-600 space-y-2 mt-10">
                        <span class="font-serif text-ink-900 uppercase tracking-widest block font-semibold">
                            Catatan Perlindungan Tradisi
                        </span>
                        <p class="leading-relaxed font-light">
                            Materi tutur ini didokumentasikan untuk pelestarian pengetahuan dan penelitian budaya. Hak kepemilikan adat atas cerita, sastra lisan, dan kidung tetap berada pada masyarakat penutur aslinya
                        </p>
                    </div>
                </div>

                <!-- Sidebar Metadata: Confined Sticky Informasi Arsip (4 cols) -->
                <aside class="lg:col-span-4">
                    <div class="lg:sticky lg:top-28 space-y-6">
                        <!-- Informasi Arsip Card -->
                        <div class="border border-linen-300 bg-linen-50 p-6 sm:p-7 space-y-5 shadow-sm">
                            <h3 class="font-serif text-xs uppercase tracking-[0.25em] text-ink-900 font-bold border-b border-linen-300 pb-3">
                                Informasi Arsip
                            </h3>

                            <!-- Region -->
                            <div>
                                <span class="text-xs uppercase tracking-wider text-ink-600 block mb-1 font-medium">
                                    Wilayah Administratif
                                </span>
                                <span class="text-xs sm:text-sm text-ink-900 font-medium">
                                    {{ $item->regency->name }}
                                </span>
                            </div>

                            <!-- Province -->
                            <div>
                                <span class="text-xs uppercase tracking-wider text-ink-600 block mb-1 font-medium">
                                    Provinsi
                                </span>
                                <span class="text-xs sm:text-sm text-ink-900 font-medium">
                                    {{ $item->regency->province->name }}
                                </span>
                            </div>

                            <!-- Integrated Share Action Row: Bagikan, Salin Link, WhatsApp -->
                            <div class="pt-5 border-t border-linen-300">
                                <span class="text-xs uppercase tracking-[0.2em] text-ink-600 block mb-3 font-semibold">
                                    Bagikan Ingatan Ini
                                </span>
                                
                                <div class="flex flex-wrap items-center gap-2">
                                    <!-- 1. Native OS Web Share API Button (44px min tap target) -->
                                    <button type="button" 
                                            id="share-trigger-btn"
                                            class="inline-flex items-center justify-center space-x-1.5 px-3.5 py-2.5 min-h-[44px] bg-obsidian-950 hover:bg-obsidian-800 text-white rounded text-xs font-sans font-medium transition-colors cursor-pointer shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-ink-900">
                                        <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <circle cx="18" cy="5" r="3"></circle>
                                            <circle cx="6" cy="12" r="3"></circle>
                                            <circle cx="18" cy="19" r="3"></circle>
                                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                        </svg>
                                        <span>Bagikan</span>
                                    </button>

                                    <!-- 2. Quick Copy Link Button (44px min tap target) -->
                                    <button type="button" 
                                            id="copy-link-btn"
                                            data-url="{{ url()->current() }}"
                                            class="inline-flex items-center justify-center space-x-1.5 px-3.5 py-2.5 min-h-[44px] border border-linen-300 hover:border-ink-900 bg-white hover:bg-linen-100 text-ink-800 rounded text-xs font-sans font-medium transition-colors cursor-pointer shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-ink-900"
                                            title="Salin tautan ke clipboard">
                                        <svg class="w-3.5 h-3.5 text-ink-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span id="copy-text">Salin Link</span>
                                    </button>

                                    <!-- 3. Quick WhatsApp Share Button (44px min tap target) -->
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($item->title . ' — ' . url()->current()) }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer" 
                                       class="inline-flex items-center justify-center space-x-1.5 px-3.5 py-2.5 min-h-[44px] border border-linen-300 hover:border-ink-900 bg-white hover:bg-linen-100 text-ink-800 rounded text-xs font-sans font-medium transition-colors shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-ink-900"
                                       title="Bagikan ke WhatsApp">
                                        <svg class="w-3.5 h-3.5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.88 2.79.88 3.18 0 5.767-2.587 5.767-5.766.001-3.181-2.585-5.766-5.766-5.766zm9.969 5.766c0 5.503-4.469 9.969-9.969 9.969-1.745 0-3.385-.453-4.82-1.246l-5.211 1.339 1.362-4.973c-.908-1.508-1.428-3.266-1.428-5.089 0-5.502 4.469-9.969 9.969-9.969 5.503 0 9.969 4.467 9.969 9.969z"/>
                                        </svg>
                                        <span>WhatsApp</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </article>

    <!-- 3. UPGRADED RELATED ARCHIVES SECTION [Proximity Ordering + Image Cards + Elevation Micro-interactions] -->
    @if($relatedItems->count() > 0)
        <section class="py-16 sm:py-20 bg-linen-200 text-ink-900 border-t border-linen-300">
            <div class="max-w-6xl mx-auto px-4 sm:px-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block mb-1 font-medium">
                            Koleksi Senada
                        </span>
                        <h3 class="font-serif text-xl sm:text-2xl font-bold uppercase tracking-tight text-ink-900">
                            Tuturan Terkait di Wilayah Ini
                        </h3>
                    </div>

                    <a href="{{ route('arsip.index', ['province' => $item->regency->province->slug]) }}" class="hidden sm:inline-flex items-center space-x-1.5 text-xs uppercase tracking-[0.18em] text-ink-600 hover:text-ink-950 font-medium transition-colors">
                        <span>Lihat Wilayah Ini</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($relatedItems as $related)
                        <article class="group border border-linen-300 bg-linen-50 hover:border-ink-800 transition-all duration-300 flex flex-col shadow-sm hover:shadow-md hover:-translate-y-1.5">
                            <!-- Thumbnail Preview with Grayscale-to-Color Transition -->
                            <a href="{{ route('arsip.show', $related->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-linen-200">
                                @if($related->thumbnail_url)
                                    <img src="{{ $related->thumbnail_url }}" 
                                         alt="{{ $related->title }}"
                                         class="w-full h-full object-cover grayscale contrast-110 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-700 ease-out"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-linen-200 text-ink-500 text-xs uppercase tracking-widest">
                                        Rekaman Terkait
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-obsidian-950/70 via-transparent to-transparent"></div>

                                <!-- Proximity Badge -->
                                <div class="absolute top-3 left-3 text-xs uppercase tracking-wider px-2.5 py-1 font-medium {{ $related->regency_id === $item->regency_id ? 'bg-ink-100 text-obsidian-950' : 'bg-obsidian-950/80 text-ink-200 border border-obsidian-700' }}">
                                    {{ $related->regency_id === $item->regency_id ? 'Wilayah Sama' : 'Provinsi Terkait' }}
                                </div>
                            </a>

                            <!-- Details -->
                            <div class="p-5 sm:p-6 flex flex-col flex-grow">
                                <span class="text-xs uppercase tracking-wider text-ink-600 block mb-1.5 font-medium">
                                    {{ $related->regency->name }}
                                </span>

                                <h4 class="font-serif text-base font-bold text-ink-900 mb-2 group-hover:text-ink-700 transition-colors leading-snug">
                                    <a href="{{ route('arsip.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h4>

                                <p class="text-xs text-ink-600 font-light line-clamp-2 mb-4 leading-relaxed">
                                    {{ $related->excerpt ?? Str::limit(strip_tags($related->description), 90) }}
                                </p>

                                <div class="mt-auto pt-3 border-t border-linen-300 flex items-center justify-between text-xs uppercase tracking-wider text-ink-700 group-hover:text-ink-900 font-medium">
                                    <span>Buka Rekaman</span>
                                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // YouTube Lite Player Loader
    const container = document.getElementById('lite-player-container');
    if (container) {
        const playVideo = function () {
            const youtubeId = container.getAttribute('data-youtube-id');
            if (!youtubeId || container.querySelector('iframe')) return;

            const iframe = document.createElement('iframe');
            iframe.setAttribute('src', `https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3`);
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
            iframe.setAttribute('allowfullscreen', 'true');
            iframe.className = 'w-full h-full absolute inset-0';

            container.innerHTML = '';
            container.appendChild(iframe);
            container.classList.remove('cursor-pointer');
            container.removeAttribute('role');
            container.removeAttribute('tabindex');
        };

        container.addEventListener('click', playVideo);
        container.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                playVideo();
            }
        });
    }

    // Native Web Share API + Quick Copy Action
    const shareTrigger = document.getElementById('share-trigger-btn');
    const copyBtn = document.getElementById('copy-link-btn');
    const copyText = document.getElementById('copy-text');

    if (shareTrigger) {
        shareTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            const shareData = {
                title: @json($item->title . ' — Budaya Tutur'),
                text: @json(Str::limit(strip_tags($item->excerpt ?? $item->description), 120)),
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData).catch((err) => {
                    if (err.name !== 'AbortError') {
                        console.error('Share error:', err);
                    }
                });
            } else if (copyBtn) {
                copyBtn.click();
            }
        });
    }

    // Copy Link Action with Feedback State
    if (copyBtn && copyText) {
        copyBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.getAttribute('data-url') || window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                const original = copyText.textContent;
                copyText.textContent = 'Tersalin!';
                copyBtn.classList.add('border-ink-900', 'bg-linen-200');
                setTimeout(() => {
                    copyText.textContent = original;
                    copyBtn.classList.remove('border-ink-900', 'bg-linen-200');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy URL:', err);
            });
        });
    }
});
</script>
@endpush
