@extends('layouts.app')

@section('title', $item->title . ' — Budaya Tutur Voices')
@section('meta_description', Str::limit(strip_tags($item->excerpt ?? $item->description), 160))
@section('og_title', $item->title . ' — ' . $item->regency->name)
@section('og_description', Str::limit(strip_tags($item->excerpt ?? $item->description), 160))
@section('og_image', $item->thumbnail_url)

@section('content')
    <!-- Breadcrumb & Top Bar [DARK: Obsidian #121110] -->
    <div class="border-b border-obsidian-700 bg-obsidian-900 py-4 px-4 sm:px-8">
        <div class="max-w-6xl mx-auto flex items-center space-x-2 text-xs uppercase tracking-[0.2em] text-ink-400">
            <a href="{{ route('home') }}" class="hover:text-ink-100 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('galleries.index') }}" class="hover:text-ink-100 transition-colors">Arsip</a>
            <span>/</span>
            <a href="{{ route('galleries.index', ['province' => $item->regency->province->slug]) }}" class="hover:text-ink-100 transition-colors">
                {{ $item->regency->province->name }}
            </a>
            <span>/</span>
            <span class="text-ink-200 truncate max-w-xs sm:max-w-md">{{ $item->title }}</span>
        </div>
    </div>

    <!-- Header & Media Theater Hero [DARK: Obsidian #121110] -->
    <header class="py-12 sm:py-16 bg-obsidian-900 text-ink-100 border-b border-obsidian-700">
        <div class="max-w-6xl mx-auto px-4 sm:px-8">
            <!-- Region & Category Badges -->
            <div class="flex flex-wrap items-center gap-3 mb-6">
                @if($item->category)
                    <span class="border border-obsidian-700 bg-obsidian-850 px-3 py-1 text-[11px] uppercase tracking-[0.2em] text-ink-200 font-medium">
                        {{ $item->category }}
                    </span>
                @endif
                <span class="text-xs uppercase tracking-[0.2em] text-ink-400 font-medium">
                    {{ $item->regency->name }}, {{ $item->regency->province->name }}
                </span>
            </div>

            <!-- Monumental Title -->
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-ink-100 leading-[1.15] mb-8">
                {{ $item->title }}
            </h1>

            <!-- Lead Excerpt -->
            @if($item->excerpt)
                <p class="text-ink-200 text-base sm:text-xl font-light leading-relaxed max-w-3xl mb-12 border-l-2 border-obsidian-600 pl-6 italic">
                    {{ $item->excerpt }}
                </p>
            @endif

            <!-- 5. LITE-EMBED YOUTUBE MEDIA CONTAINER -->
            <div class="border border-obsidian-700 bg-black overflow-hidden shadow-2xl">
                <div id="lite-player-container" 
                     class="relative w-full aspect-video bg-obsidian-950 flex items-center justify-center cursor-pointer group"
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
                    <div id="lite-player-button" class="absolute z-10 flex flex-col items-center justify-center space-y-3">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full border border-ink-100/40 bg-ink-100/15 backdrop-blur-md flex items-center justify-center text-ink-100 group-hover:scale-110 group-hover:bg-ink-100 group-hover:text-obsidian-950 transition-all duration-300 shadow-2xl">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-[0.25em] text-ink-200 group-hover:text-ink-100 font-medium">
                            Dengarkan Tuturan
                        </span>
                    </div>

                    <!-- Notice Bar Inside Player -->
                    <div class="absolute bottom-3 left-4 text-[10px] uppercase tracking-widest text-ink-300 bg-obsidian-950/80 px-2.5 py-1 backdrop-blur-sm border border-obsidian-700/80">
                        Rekaman Audio & Visual Lapangan
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Narrative & Transcription [LIGHT: Unbleached Linen #F8F5F0] -->
    <article class="py-16 sm:py-24 bg-linen-100 text-ink-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 sm:gap-16">
                <!-- Main Narrative & Transcription -->
                <div class="lg:col-span-8 space-y-8">
                    <h2 class="font-serif text-xl sm:text-2xl font-bold uppercase tracking-tight text-ink-900 border-b border-linen-300 pb-4">
                        Konteks Kultural & Narasi Tuturan
                    </h2>

                    <!-- Editorial Body Text (Ink on Linen: Superb Reading Ergonomics) -->
                    <div class="text-ink-700 text-sm sm:text-base leading-relaxed space-y-6 font-light">
                        {!! nl2br(e($item->description)) !!}
                    </div>

                    <!-- Archival Notice Box -->
                    <div class="p-6 border border-linen-300 bg-linen-200/80 text-xs text-ink-600 space-y-2 mt-12">
                        <span class="font-serif text-ink-900 uppercase tracking-widest block font-semibold">
                            Catatan Perlindungan Tradisi
                        </span>
                        <p class="leading-relaxed font-light">
                            Materi tutur ini didokumentasikan untuk pelestarian pengetahuan dan penelitian budaya. Hak kepemilikan adat atas cerita, sastra lisan, dan kidung tetap berada pada masyarakat penutur aslinya.
                        </p>
                    </div>
                </div>

                <!-- Sidebar Metadata -->
                <aside class="lg:col-span-4 space-y-8">
                    <div class="border border-linen-300 bg-linen-50 p-6 sm:p-8 space-y-6 shadow-sm">
                        <h3 class="font-serif text-xs uppercase tracking-[0.25em] text-ink-900 font-bold border-b border-linen-300 pb-3">
                            Informasi Arsip
                        </h3>

                        <!-- Region -->
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-ink-500 block mb-1 font-medium">
                                Wilayah Administratif
                            </span>
                            <span class="text-xs text-ink-900 font-medium">
                                {{ $item->regency->name }}
                            </span>
                        </div>

                        <!-- Province -->
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-ink-500 block mb-1 font-medium">
                                Provinsi
                            </span>
                            <span class="text-xs text-ink-900 font-medium">
                                {{ $item->regency->province->name }}
                            </span>
                        </div>

                        <!-- Centroid Coordinates -->
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-ink-500 block mb-1 font-medium">
                                Koordinat Wilayah (Centroid)
                            </span>
                            <span class="text-xs font-mono text-ink-700">
                                {{ number_format($item->regency->latitude, 4) }}&deg;, {{ number_format($item->regency->longitude, 4) }}&deg;
                            </span>
                        </div>

                        <!-- Category -->
                        @if($item->category)
                            <div>
                                <span class="text-[10px] uppercase tracking-widest text-ink-500 block mb-1 font-medium">
                                    Ragam Seni / Kategori
                                </span>
                                <span class="text-xs text-ink-900 font-medium">
                                    {{ $item->category }}
                                </span>
                            </div>
                        @endif

                        <!-- Media ID -->
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-ink-500 block mb-1 font-medium">
                                Kode Referensi Media
                            </span>
                            <span class="text-xs font-mono text-ink-700">
                                YT-{{ $item->youtube_id }}
                            </span>
                        </div>
                    </div>

                    <!-- Share Action -->
                    <div class="border border-linen-300 bg-linen-50 p-6 space-y-3 text-center shadow-sm">
                        <span class="text-[10px] uppercase tracking-[0.2em] text-ink-500 block font-medium">
                            Bagikan Ingatan Ini
                        </span>
                        <div class="flex items-center justify-center space-x-3 text-xs">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($item->title . ' — ' . url()->current()) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="px-4 py-2 border border-linen-300 hover:border-ink-900 text-ink-700 hover:text-ink-900 uppercase tracking-wider text-[11px] transition-colors font-medium">
                                WhatsApp
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($item->title . ' ' . url()->current()) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="px-4 py-2 border border-linen-300 hover:border-ink-900 text-ink-700 hover:text-ink-900 uppercase tracking-wider text-[11px] transition-colors font-medium">
                                X / Twitter
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </article>

    <!-- Related Archives Section [LIGHT: Warm Linen #F2ECE2] -->
    @if($relatedItems->count() > 0)
        <section class="py-20 bg-linen-200 text-ink-900 border-t border-linen-300">
            <div class="max-w-6xl mx-auto px-4 sm:px-8">
                <h3 class="font-serif text-xl sm:text-2xl font-bold uppercase tracking-tight text-ink-900 mb-8">
                    Tuturan Terkait di Wilayah Ini
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedItems as $related)
                        <article class="group border border-linen-300 bg-linen-50 p-6 flex flex-col justify-between shadow-sm">
                            <div>
                                <span class="text-[10px] uppercase tracking-widest text-ink-500 block mb-2 font-medium">
                                    {{ $related->regency->name }}
                                </span>
                                <h4 class="font-serif text-base font-bold text-ink-900 mb-2 group-hover:text-ink-700 transition-colors">
                                    <a href="{{ route('galleries.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                                <p class="text-xs text-ink-600 font-light line-clamp-2 mb-4">
                                    {{ $related->excerpt ?? Str::limit(strip_tags($related->description), 90) }}
                                </p>
                            </div>
                            <a href="{{ route('galleries.show', $related->slug) }}" class="text-[11px] uppercase tracking-wider text-ink-700 group-hover:text-ink-900 inline-flex items-center transition-colors font-medium">
                                Buka Rekaman &rarr;
                            </a>
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
    const container = document.getElementById('lite-player-container');
    if (!container) return;

    container.addEventListener('click', function () {
        const youtubeId = this.getAttribute('data-youtube-id');
        if (!youtubeId) return;

        const iframe = document.createElement('iframe');
        iframe.setAttribute('src', `https://www.youtube-nocookie.com/embed/${youtubeId}?autoplay=1&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3`);
        iframe.setAttribute('frameborder', '0');
        iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
        iframe.setAttribute('allowfullscreen', 'true');
        iframe.className = 'w-full h-full absolute inset-0';

        this.innerHTML = '';
        this.appendChild(iframe);
        this.classList.remove('cursor-pointer');
    });
});
</script>
@endpush
