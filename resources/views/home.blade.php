@extends('layouts.app')

@section('title', 'Budaya Tutur Voices — Arsip Suara & Cerita Lisan Nusantara')

@section('content')
    <!-- 1. HERO SECTION [DARK: Obsidian #121110 Velvet] -->
    <section class="relative bg-obsidian-900 border-b border-obsidian-700 min-h-0 sm:min-h-[calc(100vh-5rem)] sm:min-h-[calc(100dvh-5rem)] py-14 sm:py-20 md:py-24 flex flex-col justify-center overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight (Subtle smoky bone aura and warm peat vignette) -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_38%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[40%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[650px] sm:w-[900px] h-[320px] sm:h-[420px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>
        
        <div class="relative max-w-5xl mx-auto px-4 sm:px-8 text-center flex-grow flex flex-col justify-center my-auto">
            <!-- Monumental Editorial Heading -->
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight text-ink-100 leading-[1.15] uppercase mb-6 sm:mb-8">
                Menjaga yang Terucap<br class="hidden sm:inline"> Sebelum Senyap
            </h1>

            <!-- Understated Archival Lead (Anti-slop: natural, grounded) -->
            <p class="text-ink-300 text-sm sm:text-base md:text-lg max-w-2xl mx-auto font-light leading-relaxed mb-8 sm:mb-12">
                Rekaman suara, nyanyian adat, mantra, dan tuturan lisan dari tetua di berbagai penjuru kepulauan. Kami merawat tuturan ini agar tetap terdengar oleh generasi berikutnya.
            </p>

            <!-- Action CTAs (Touch-friendly 44px min targets) -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('arsip.index') }}" class="w-full sm:w-auto min-h-[48px] px-8 py-4 bg-ink-100 text-obsidian-950 font-semibold hover:bg-linen-200 transition-colors duration-300 flex items-center justify-center">
                    Jelajahi Arsip Suara
                </a>
                <a href="#peta" class="w-full sm:w-auto min-h-[48px] px-8 py-4 border border-obsidian-700 text-ink-200 hover:text-ink-100 hover:border-obsidian-500 transition-colors duration-300 flex items-center justify-center">
                    Lihat Peta Wilayah
                </a>
            </div>
        </div>
    </section>

    <!-- 2. INTERACTIVE CENTROID MAP [LIGHT: Unbleached Linen #F8F5F0] -->
    <section id="peta" class="py-16 sm:py-24 md:py-32 bg-linen-100 text-ink-900 border-b border-linen-300 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Section Header -->
            <div class="max-w-3xl mb-8 sm:mb-10">
                <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block mb-2 font-medium">
                    Bentang Wilayah Tutur
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-900 mb-4">
                    Peta Sebaran Budaya Tutur
                </h2>
                <p class="text-ink-600 text-xs sm:text-sm leading-relaxed font-light">
                    Tiap titik merekam tuturan lisan dari tanah asalnya. Ketuk penanda atau pilih wilayah untuk membuka naskah dan rekaman yang tersimpan.
                </p>
            </div>

            <!-- Leaflet Map Container (Archival Plate Frame) -->
            <div class="border border-linen-300 bg-linen-200 relative overflow-hidden shadow-xl">
                <div id="culture-map" class="w-full h-[420px] sm:h-[520px] md:h-[600px] z-10"></div>

                <!-- Map Controls Overlay -->
                <div class="absolute top-4 right-4 z-20">
                    <button id="reset-map-btn" 
                            type="button" 
                            class="bg-linen-50/95 backdrop-blur-md border border-linen-300 px-3 sm:px-3.5 py-2 min-h-[40px] text-xs tracking-wider text-ink-700 hover:text-ink-950 hover:border-ink-600 uppercase transition-all flex items-center space-x-2 focus:outline-none focus-visible:ring-1 focus-visible:ring-ink-900 shadow-md cursor-pointer"
                            aria-label="Pusatkan peta ke nusantara">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="hidden sm:inline">Pusatkan Nusantara</span>
                        <span class="sm:hidden">Pusatkan</span>
                    </button>
                </div>

                <!-- Map Legend Overlay -->
                <div class="absolute bottom-4 left-4 z-20 bg-linen-50/95 backdrop-blur-md border border-linen-300 px-3 py-1.5 sm:px-3.5 sm:py-2 text-[11px] sm:text-xs tracking-wider text-ink-800 uppercase shadow-md flex items-center space-x-2 pointer-events-none">
                    <span class="w-2.5 h-2.5 rounded-full bg-ink-900 border border-linen-100 inline-block shadow-sm"></span>
                    <span>Wilayah Berpenutur</span>
                </div>

                <!-- Archival Sliding Drawer (Side-docked on desktop, bottom-sheet on mobile) -->
                <div id="map-drawer" 
                     class="absolute z-30 transition-all duration-300 ease-out inset-x-0 bottom-0 max-h-[85%] sm:max-h-full sm:inset-y-0 sm:left-auto sm:right-0 sm:w-96 w-full bg-obsidian-900/98 backdrop-blur-md text-ink-100 border-t sm:border-t-0 sm:border-l border-obsidian-700 shadow-2xl flex flex-col pointer-events-auto translate-y-full sm:translate-y-0 sm:translate-x-full pb-safe">
                    
                    <!-- Mobile drag handle indicator -->
                    <div class="w-10 h-1 bg-obsidian-700 rounded-full mx-auto mt-2.5 mb-1 sm:hidden" aria-hidden="true"></div>

                    <!-- Drawer Header -->
                    <div class="p-5 sm:p-6 border-b border-obsidian-700 flex items-start justify-between">
                        <div>
                            <span id="drawer-province" class="text-[10px] uppercase tracking-[0.22em] text-ink-400 block font-medium">
                                Wilayah
                            </span>
                            <h3 id="drawer-regency" class="font-serif text-xl sm:text-2xl font-bold text-ink-100 mt-1 leading-snug">
                                Nama Wilayah
                            </h3>
                            <div id="drawer-count" class="text-xs text-ink-400 mt-1.5 font-light">
                                0 tuturan terekam di tanah ini
                            </div>
                        </div>
                        <button id="drawer-close-btn" 
                                type="button" 
                                class="text-ink-400 hover:text-ink-100 p-2 min-w-[44px] min-h-[44px] flex items-center justify-center border border-transparent hover:border-obsidian-700 transition-colors focus:outline-none focus-visible:ring-1 focus-visible:ring-ink-100 cursor-pointer" 
                                aria-label="Tutup Panel">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Drawer Items List (Scrollable) -->
                    <div id="drawer-items-list" class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-3 scrollbar-thin scrollbar-thumb-obsidian-700">
                        <!-- Populated by JavaScript -->
                    </div>

                    <!-- Drawer Footer Link -->
                    <div class="p-4 sm:p-5 border-t border-obsidian-700 bg-obsidian-950/60 mt-auto">
                        <a id="drawer-province-link" href="#" class="text-xs uppercase tracking-[0.18em] text-ink-300 hover:text-ink-100 inline-flex items-center justify-between w-full font-medium group transition-colors min-h-[36px]">
                            <span id="drawer-province-link-text">Buka Seluruh Arsip Provinsi &rarr;</span>
                        </a>
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
                    <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-2 font-medium">
                        Pilihan Kuratorial
                    </span>
                    <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-100">
                        Rekaman Pilihan
                    </h2>
                </div>
                <a href="{{ route('arsip.index') }}" class="text-xs uppercase tracking-[0.2em] text-ink-300 hover:text-ink-100 inline-flex items-center group transition-colors font-medium">
                    Lihat Seluruh Katalog
                    <span class="ml-2 group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>

            <!-- Cards Grid (Mounted on Peat Obsidian Surface) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse($featuredItems as $item)
                    <a href="{{ route('arsip.show', $item->slug) }}" class="group bg-obsidian-850 border border-obsidian-700 hover:border-ink-200 transition-all duration-300 flex flex-col shadow-lg cursor-pointer focus:outline-none focus:ring-1 focus:ring-ink-200">
                        <!-- Thumbnail Wrapper with Grayscale Filter -->
                        <div class="relative block aspect-[16/10] overflow-hidden bg-obsidian-950">
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
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 sm:p-8 flex flex-col flex-grow">
                            <!-- Location pill -->
                            <div class="text-xs uppercase tracking-[0.2em] text-ink-400 mb-2 font-medium">
                                {{ $item->regency->name }}, {{ $item->regency->province->name }}
                            </div>

                            <!-- Title -->
                            <h3 class="font-serif text-lg sm:text-xl font-bold text-ink-100 mb-3 group-hover:text-ink-200 transition-colors leading-snug">
                                {{ $item->title }}
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-ink-300 text-xs sm:text-sm leading-relaxed mb-6 font-light line-clamp-3">
                                {{ $item->excerpt ?? Str::limit(strip_tags($item->description), 130) }}
                            </p>

                            <!-- Footer link -->
                            <div class="mt-auto pt-4 border-t border-obsidian-700 flex items-center justify-between text-xs uppercase tracking-[0.2em] text-ink-300 font-medium">
                                <span class="group-hover:text-ink-100 transition-colors">Buka Rekaman</span>
                                <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                            </div>
                        </div>
                    </a>
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
            <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block font-medium">
                Catatan Pengarsipan
            </span>
            <blockquote class="font-serif text-2xl sm:text-3xl md:text-4xl text-ink-900 font-medium italic leading-relaxed">
                &ldquo;Batu dan naskah bisa lapuk, tetapi bunyi yang dirawat dalam ingatan lisan akan melintasi masa dan terus menuturkan asal-usul kita.&rdquo;
            </blockquote>
            <p class="text-ink-600 text-xs sm:text-sm leading-relaxed max-w-2xl mx-auto font-light">
                Budaya Tutur Voices hadir sebagai ruang simpan digital independen. Kami memprioritaskan tuturan lisan dari komunitas yang belum banyak terdokumentasi, menyajikannya secara khidmat tanpa komersialisasi.
            </p>
            <div class="pt-6">
                <a href="{{ route('kontak') }}" class="inline-block px-8 py-3.5 border border-ink-900 text-xs uppercase tracking-[0.2em] text-ink-900 hover:bg-ink-900 hover:text-linen-100 transition-all duration-300 font-medium">
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

    const bounds = [];
    const markerMap = {};
    const pillMap = {};
    let activeMarker = null;

    // Drawer Elements
    const drawer = document.getElementById('map-drawer');
    const drawerProvince = document.getElementById('drawer-province');
    const drawerRegency = document.getElementById('drawer-regency');
    const drawerCount = document.getElementById('drawer-count');
    const drawerItemsList = document.getElementById('drawer-items-list');
    const drawerProvinceLink = document.getElementById('drawer-province-link');
    const drawerProvinceLinkText = document.getElementById('drawer-province-link-text');
    const drawerCloseBtn = document.getElementById('drawer-close-btn');
    const resetBtn = document.getElementById('reset-map-btn');

    function openDrawer(regency, markerEl) {
        if (!drawer) return;

        drawerProvince.textContent = regency.province ? regency.province.name : 'Wilayah';
        drawerRegency.textContent = regency.name;
        drawerCount.textContent = `${regency.culture_items.length} tuturan terekam di tanah ini:`;

        let listHtml = '';
        regency.culture_items.forEach(function (item) {
            const url = "{{ url('/arsip') }}/" + item.slug;
            const category = item.category || 'Budaya Tutur';
            listHtml += `
                <a href="${url}" class="group block p-4 bg-obsidian-850 border border-obsidian-700 hover:border-ink-200 transition-all duration-200 shadow-sm focus:outline-none focus:border-ink-100">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-[10px] uppercase tracking-[0.2em] text-ink-400 font-medium">${category}</span>
                        <span class="text-ink-400 group-hover:text-ink-100 group-hover:translate-x-1 transition-transform text-xs font-serif">&rarr;</span>
                    </div>
                    <h4 class="font-serif text-base sm:text-lg font-bold text-ink-100 group-hover:text-ink-200 leading-snug">
                        ${item.title}
                    </h4>
                    <div class="mt-2.5 text-[11px] text-ink-400 flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-ink-400 group-hover:text-ink-200 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="group-hover:text-ink-200 transition-colors">Buka naskah dan rekaman</span>
                    </div>
                </a>
            `;
        });
        drawerItemsList.innerHTML = listHtml;

        if (regency.province && regency.province.slug) {
            drawerProvinceLink.href = "{{ route('arsip.index') }}?province=" + regency.province.slug;
            drawerProvinceLinkText.innerHTML = `Buka Seluruh Arsip ${regency.province.name} &rarr;`;
            drawerProvinceLink.parentElement.style.display = 'block';
        } else {
            drawerProvinceLink.parentElement.style.display = 'none';
        }

        // Open Drawer Animation Classes
        drawer.classList.remove('translate-y-full', 'sm:translate-x-full');
        drawer.classList.add('translate-y-0', 'sm:translate-x-0');

        // Toggle active marker styling
        document.querySelectorAll('.custom-sound-marker').forEach(m => m.classList.remove('is-active'));
        if (markerEl) {
            markerEl.classList.add('is-active');
        }
    }

    function closeDrawer() {
        if (!drawer) return;

        drawer.classList.add('translate-y-full', 'sm:translate-x-full');
        drawer.classList.remove('translate-y-0', 'sm:translate-x-0');

        document.querySelectorAll('.custom-sound-marker').forEach(m => m.classList.remove('is-active'));
        activeMarker = null;
    }

    regenciesData.forEach(function (regency) {
        if (!regency.latitude || !regency.longitude) return;

        const latLng = [parseFloat(regency.latitude), parseFloat(regency.longitude)];
        bounds.push(latLng);

        const itemCount = regency.culture_items.length;
        const isMultiple = itemCount > 1;
        const coreSize = isMultiple ? 22 : 16;
        const anchor = coreSize / 2;

        const markerHtml = `
            <div class="custom-sound-marker" data-regency-id="${regency.id}">
                <div class="marker-pulse-ring"></div>
                <div class="marker-core" style="width: ${coreSize}px; height: ${coreSize}px;">
                    ${isMultiple ? `<span>${itemCount}</span>` : ''}
                </div>
            </div>
        `;

        const icon = L.divIcon({
            className: 'sound-marker-wrapper',
            html: markerHtml,
            iconSize: [coreSize, coreSize],
            iconAnchor: [anchor, anchor]
        });

        const marker = L.marker(latLng, { icon: icon }).addTo(map);
        markerMap[regency.id] = { marker, regency, latLng };

        marker.on('click', function (e) {
            if (e.originalEvent) {
                e.originalEvent.stopPropagation();
            }
            activeMarker = marker;
            const markerEl = marker._icon ? marker._icon.querySelector('.custom-sound-marker') : null;
            const currentZoom = map.getZoom();
            map.flyTo(latLng, Math.max(currentZoom, 7), { duration: 0.8 });
            openDrawer(regency, markerEl);
        });
    });

    if (drawerCloseBtn) {
        drawerCloseBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeDrawer();
        });
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            closeDrawer();
            if (bounds.length > 0) {
                map.fitBounds(bounds, { padding: [40, 40], maxZoom: 7 });
            } else {
                map.setView([-2.5, 118.0], 5);
            }
        });
    }

    // Close drawer when clicking outside markers or drawer
    map.on('click', function (e) {
        if (e.originalEvent && !e.originalEvent.target.closest('#map-drawer') && !e.originalEvent.target.closest('.custom-sound-marker')) {
            closeDrawer();
        }
    });

    // Close drawer on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeDrawer();
        }
    });

    // Invalidate map size on viewport resize and orientation change
    let resizeTimer = null;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            map.invalidateSize();
        }, 150);
    });

    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50], maxZoom: 7 });
    }
});
</script>
@endpush
