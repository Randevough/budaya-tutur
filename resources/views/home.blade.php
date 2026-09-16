@extends('layouts.app')

@section('title', 'Budaya Tutur Voices — Arsip Suara & Cerita Lisan Nusantara')

@section('content')
    <!-- 1. HERO SECTION [DARK: Obsidian #121110 Velvet] (Exact Full Viewport 100vh/100dvh) -->
    <section class="relative bg-obsidian-900 border-b border-obsidian-700 min-h-[calc(100vh-5rem)] min-h-[calc(100dvh-5rem)] py-12 sm:py-16 flex flex-col justify-center overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight (Subtle smoky bone aura and warm peat vignette) -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_38%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[40%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[650px] sm:w-[900px] h-[320px] sm:h-[420px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>
        
        <div class="relative max-w-5xl mx-auto px-4 sm:px-8 text-center flex-grow flex flex-col justify-center my-auto">
            <!-- Monumental Editorial Heading -->
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight text-ink-100 leading-[1.1] uppercase mb-6 sm:mb-8">
                Menjaga yang Terucap<br class="hidden sm:inline"> Sebelum Senyap
            </h1>

            <!-- Understated Archival Lead (Anti-slop: natural, grounded) -->
            <p class="text-ink-300 text-sm sm:text-base md:text-lg max-w-2xl mx-auto font-light leading-relaxed mb-8 sm:mb-12">
                Rekaman suara, nyanyian adat, mantra, dan tuturan lisan dari tetua di berbagai penjuru kepulauan. Kami merawat tuturan ini agar tetap terdengar oleh generasi berikutnya.
            </p>

            <!-- Action CTAs -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('galleries.index') }}" class="w-full sm:w-auto px-8 py-4 bg-ink-100 text-obsidian-950 font-semibold hover:bg-linen-200 transition-colors duration-300">
                    Jelajahi Arsip Suara
                </a>
                <a href="#peta" class="w-full sm:w-auto px-8 py-4 border border-obsidian-700 text-ink-200 hover:text-ink-100 hover:border-obsidian-500 transition-colors duration-300">
                    Lihat Peta Wilayah
                </a>
            </div>
        </div>
    </section>

    <!-- 2. INTERACTIVE CENTROID MAP [LIGHT: Unbleached Linen #F8F5F0] -->
    <section id="peta" class="py-24 sm:py-32 bg-linen-100 text-ink-900 border-b border-linen-300 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Section Header -->
            <div class="max-w-3xl mb-12">
                <span class="text-[11px] uppercase tracking-[0.3em] text-ink-500 block mb-2 font-medium">
                    Kartografi Suara
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-900 mb-4">
                    Peta Sebaran Budaya Tutur
                </h2>
                <p class="text-ink-600 text-xs sm:text-sm leading-relaxed font-light">
                    Satu penanda mewakili titik pusat kabupaten atau kota yang menyimpan rekaman budaya tutur. Klik pada penanda untuk melihat daftar tuturan yang tercatat di wilayah tersebut.
                </p>
            </div>

            <!-- Leaflet Map Container (Archival Plate Frame) -->
            <div class="border border-linen-300 bg-linen-200 relative overflow-hidden shadow-xl">
                <div id="culture-map" class="w-full h-[540px] z-10"></div>
                
                <!-- Map Controls Overlay -->
                <div class="absolute top-4 right-4 z-20">
                    <button id="reset-map-btn" type="button" class="bg-linen-50/95 backdrop-blur-md border border-linen-300 px-3 py-2 text-[10px] tracking-widest text-ink-700 hover:text-ink-950 hover:border-ink-600 uppercase transition-all flex items-center space-x-2 focus:outline-none shadow-md">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span>Pusatkan Peta</span>
                    </button>
                </div>

                <!-- Map Legend Overlay -->
                <div class="absolute bottom-4 left-4 z-20 bg-linen-50/95 backdrop-blur-md border border-linen-300 px-4 py-3 text-[11px] tracking-wider text-ink-800 uppercase shadow-md">
                    <div class="flex items-center space-x-2.5">
                        <span class="w-3 h-3 rounded-full bg-ink-900 border-2 border-linen-100 inline-block shadow-sm"></span>
                        <span>Titik Pusat Kabupaten Berkoleksi</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. CURATED VOICES SHOWCASE [DARK: Obsidian #121110] -->
    <section id="arsip" class="py-24 sm:py-32 bg-obsidian-900 text-ink-100 border-b border-obsidian-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-16 pb-6 border-b border-obsidian-700 gap-6">
                <div>
                    <span class="text-[11px] uppercase tracking-[0.3em] text-ink-400 block mb-2 font-medium">
                        Pilihan Kuratorial
                    </span>
                    <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-100">
                        Rekaman Pilihan
                    </h2>
                </div>
                <a href="{{ route('galleries.index') }}" class="text-xs uppercase tracking-[0.2em] text-ink-300 hover:text-ink-100 inline-flex items-center group transition-colors font-medium">
                    Lihat Seluruh Katalog
                    <span class="ml-2 group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>

            <!-- Cards Grid (Mounted on Peat Obsidian Surface) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse($featuredItems as $item)
                    <article class="group bg-obsidian-850 border border-obsidian-700 hover:border-ink-200 transition-all duration-300 flex flex-col shadow-lg">
                        <!-- Thumbnail Wrapper with Grayscale Filter -->
                        <a href="{{ route('galleries.show', $item->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-obsidian-950">
                            @if($item->thumbnail_url)
                                <img src="{{ $item->thumbnail_url }}" 
                                     alt="{{ $item->title }}"
                                     class="w-full h-full object-cover grayscale contrast-110 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-700 ease-out"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-obsidian-950 text-ink-500 text-xs uppercase tracking-widest">
                                    Rekaman Suara
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-obsidian-950/80 via-transparent to-transparent"></div>

                            <!-- Audio Indicator Overlay -->
                            <div class="absolute bottom-4 right-4 w-9 h-9 rounded-full bg-obsidian-950/80 border border-ink-100/30 flex items-center justify-center text-ink-100 group-hover:bg-ink-100 group-hover:text-obsidian-950 transition-colors duration-300">
                                <svg class="w-4 h-4 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </a>

                        <!-- Card Body -->
                        <div class="p-6 sm:p-8 flex flex-col flex-grow">
                            <!-- Location pill -->
                            <div class="text-[11px] uppercase tracking-[0.2em] text-ink-400 mb-2 font-medium">
                                {{ $item->regency->name }}, {{ $item->regency->province->name }}
                            </div>

                            <!-- Title -->
                            <h3 class="font-serif text-lg sm:text-xl font-bold text-ink-100 mb-3 group-hover:text-ink-200 transition-colors leading-snug">
                                <a href="{{ route('galleries.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-ink-300 text-xs sm:text-sm leading-relaxed mb-6 font-light line-clamp-3">
                                {{ $item->excerpt ?? Str::limit(strip_tags($item->description), 130) }}
                            </p>

                            <!-- Footer link -->
                            <div class="mt-auto pt-4 border-t border-obsidian-700 flex items-center justify-between text-[11px] uppercase tracking-[0.2em] text-ink-300 font-medium">
                                <span class="group-hover:text-ink-100 transition-colors">Buka Rekaman</span>
                                <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-16 border border-dashed border-obsidian-700 text-ink-400 text-sm">
                        Belum ada arsip yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 4. EDITORIAL MANIFESTO [LIGHT: Warm Linen #F2ECE2] -->
    <section id="tentang" class="py-28 sm:py-36 bg-linen-200 text-ink-900 border-b border-linen-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center space-y-8">
            <span class="text-[11px] uppercase tracking-[0.3em] text-ink-500 block font-medium">
                Catatan Pengarsipan
            </span>
            <blockquote class="font-serif text-2xl sm:text-3xl md:text-4xl text-ink-900 font-medium italic leading-relaxed">
                &ldquo;Batu dan naskah bisa lapuk, tetapi bunyi yang dirawat dalam ingatan lisan akan melintasi masa dan terus menuturkan asal-usul kita.&rdquo;
            </blockquote>
            <p class="text-ink-600 text-xs sm:text-sm leading-relaxed max-w-2xl mx-auto font-light">
                Budaya Tutur Voices hadir sebagai ruang simpan digital independen. Kami memprioritaskan tuturan lisan dari komunitas yang belum banyak terdokumentasi, menyajikannya secara khidmat tanpa komersialisasi.
            </p>
            <div class="pt-6">
                <a href="{{ route('contact') }}" class="inline-block px-8 py-3.5 border border-ink-900 text-xs uppercase tracking-[0.2em] text-ink-900 hover:bg-ink-900 hover:text-linen-100 transition-all duration-300 font-medium">
                    Hubungi Kami / Usulkan Rekaman
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const regenciesData = @json($mapRegencies);

    const map = L.map('culture-map', {
        center: [-2.5, 118.0],
        zoom: 5,
        minZoom: 4,
        maxZoom: 12,
        scrollWheelZoom: false,
        attributionControl: false
    });

    // Esri World Light Gray Canvas for Archival Exhibition Theme
    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
        attribution: '&copy; <a href="https://www.esri.com/">Esri</a> &mdash; Esri, DeLorme, NAVTEQ',
        maxZoom: 16
    }).addTo(map);

    const monoIcon = L.divIcon({
        className: 'custom-mono-marker',
        html: `
            <div style="
                width: 14px;
                height: 14px;
                background-color: #181615;
                border: 2px solid #f8f5f0;
                border-radius: 50%;
                box-shadow: 0 0 10px rgba(24, 22, 21, 0.4);
                cursor: pointer;
            "></div>
        `,
        iconSize: [14, 14],
        iconAnchor: [7, 7],
        popupAnchor: [0, -10]
    });

    const bounds = [];

    regenciesData.forEach(function (regency) {
        if (!regency.latitude || !regency.longitude) return;

        const latLng = [parseFloat(regency.latitude), parseFloat(regency.longitude)];
        bounds.push(latLng);

        let itemsHtml = '<ul style="list-style: none; padding: 0; margin: 8px 0 0 0;">';
        regency.culture_items.forEach(function (item) {
            const url = "{{ url('/galleries') }}/" + item.slug;
            itemsHtml += `
                <li style="margin-bottom: 6px; padding-bottom: 6px; border-bottom: 1px solid #e3ddd3;">
                    <a href="${url}" style="color: #181615; text-decoration: none; font-size: 12px; font-weight: 600; display: block;">
                        &rarr; ${item.title}
                    </a>
                </li>
            `;
        });

        if (regency.province && regency.province.slug) {
            const provinceUrl = "{{ route('galleries.index') }}?province=" + regency.province.slug;
            itemsHtml += `
                <li style="margin-top: 10px; padding-top: 6px; border-top: 1px dashed #d0c8bb; text-align: right;">
                    <a href="${provinceUrl}" style="color: #5c554e; text-decoration: none; font-size: 10px; text-transform: uppercase; letter-spacing: 0.12em; font-weight: 600;">
                        Lihat Seluruh ${regency.province.name} &rarr;
                    </a>
                </li>
            `;
        }

        itemsHtml += '</ul>';

        const popupContent = `
            <div style="font-family: 'Aktiv Grotesk Condensed', sans-serif; min-width: 200px; color: #181615;">
                <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em; color: #7a736a;">
                    ${regency.province ? regency.province.name : 'Wilayah'}
                </div>
                <div style="font-family: 'Mencken Std Head', serif; font-size: 14px; font-weight: bold; color: #181615; margin-top: 2px;">
                    ${regency.name}
                </div>
                <div style="font-size: 11px; color: #5c554e; margin-top: 4px; font-weight: 300;">
                    ${regency.culture_items.length} rekaman tersimpan:
                </div>
                ${itemsHtml}
            </div>
        `;

        L.marker(latLng, { icon: monoIcon })
            .addTo(map)
            .bindPopup(popupContent);
    });

    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50], maxZoom: 7 });
    }

    const resetBtn = document.getElementById('reset-map-btn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            if (bounds.length > 0) {
                map.fitBounds(bounds, { padding: [50, 50], maxZoom: 7 });
            } else {
                map.setView([-2.5, 118.0], 5);
            }
        });
    }
});
</script>
@endpush
