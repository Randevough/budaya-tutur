@extends('layouts.app')

@section('title', 'Budaya Tutur — Arsip Suara & Cerita Lisan Nusantara')

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
                Rekaman suara, nyanyian adat, mantra, dan tuturan lisan dari tetua di berbagai penjuru kepulauan. Kami merawat tuturan ini agar tetap terdengar oleh generasi berikutnya
            </p>

            <!-- Action CTAs (Touch-friendly 44px min targets with refined micro-interactions) -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('arsip.index') }}" 
                   class="w-full sm:w-auto min-h-[48px] px-8 py-4 bg-ink-100 text-obsidian-950 font-semibold hover:bg-linen-200 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.99] transition-all duration-300 flex items-center justify-center">
                    Jelajahi Arsip Suara
                </a>
                <a href="#peta" 
                   class="group relative w-full sm:w-auto min-h-[48px] px-8 py-4 border border-obsidian-700 text-ink-200 hover:text-ink-100 hover:border-ink-300 hover:bg-obsidian-850/80 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.99] transition-all duration-300 flex items-center justify-center space-x-2">
                    <span>Lihat Peta Wilayah</span>
                    <svg class="w-3.5 h-3.5 text-ink-400 group-hover:text-ink-100 transition-all duration-300 ease-out group-hover:translate-y-1" 
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <polyline points="19 12 12 19 5 12"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- 2. INTERACTIVE CENTROID MAP [LIGHT: Unbleached Linen #F8F5F0] -->
    <section id="peta" class="py-12 sm:py-16 md:py-20 bg-linen-100 text-ink-900 border-b border-linen-300 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Section Header -->
            <div class="max-w-3xl mb-6 sm:mb-8">
                <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block mb-2 font-medium">
                    Geografi Suara
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-900 mb-3">
                    Peta Suara Nusantara
                </h2>
                <p class="text-ink-600 text-xs sm:text-sm leading-relaxed font-light">
                    Pilih titik di peta untuk mendengar rekaman penutur dan membaca naskah lapangannya
                </p>
            </div>

            <!-- Leaflet Map Container (Archival Plate Frame) -->
            <div class="border border-linen-300 bg-linen-200 relative overflow-hidden shadow-xl">
                <div id="culture-map" class="w-full h-[360px] sm:h-[440px] md:h-[480px] z-10"></div>

                <!-- Map Controls Overlay -->
                <div class="absolute top-4 right-4 z-20">
                    <button id="reset-map-btn" 
                            type="button" 
                            class="bg-linen-50/95 backdrop-blur-md border border-linen-300 px-3 sm:px-3.5 py-2 min-h-[40px] text-xs tracking-wider text-ink-700 hover:text-ink-950 hover:border-ink-600 uppercase transition-all flex items-center space-x-2 focus:outline-none focus-visible:ring-1 focus-visible:ring-ink-900 shadow-md cursor-pointer"
                            aria-label="Kembali ke bentang nusantara">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="hidden sm:inline">Kembali ke Nusantara</span>
                        <span class="sm:hidden">Kembali</span>
                    </button>
                </div>

                <!-- Map Legend Overlay -->
                <div class="absolute bottom-4 left-4 z-20 bg-linen-50/95 backdrop-blur-md border border-linen-300 px-3 py-1.5 sm:px-3.5 sm:py-2 text-[11px] sm:text-xs tracking-wider text-ink-800 uppercase shadow-md flex items-center space-x-2 pointer-events-none">
                    <span class="w-2.5 h-2.5 rounded-full bg-ink-900 border border-linen-100 inline-block shadow-sm"></span>
                    <span>Titik Rekaman</span>
                </div>

                <!-- Archival Sliding Drawer (Side-docked on desktop, bottom-sheet on mobile) [Option A: Archival Linen Dossier] -->
                <div id="map-drawer" 
                     class="absolute z-30 transition-all duration-300 ease-out inset-x-0 bottom-0 max-h-[85%] sm:max-h-full sm:inset-y-0 sm:left-auto sm:right-0 sm:w-96 w-full bg-linen-50 border-t sm:border-t-0 sm:border-l border-linen-300 shadow-2xl flex flex-col pointer-events-auto translate-y-full sm:translate-y-0 sm:translate-x-full pb-safe">
                    
                    <!-- Mobile drag handle indicator -->
                    <div class="w-10 h-1 bg-linen-300 rounded-full mx-auto mt-2.5 mb-1 sm:hidden flex-shrink-0" aria-hidden="true"></div>

                    <!-- Drawer Header -->
                    <div class="p-5 sm:p-6 border-b border-linen-300 flex items-start justify-between bg-linen-50 flex-shrink-0">
                        <div>
                            <span id="drawer-province" class="text-[10px] uppercase tracking-[0.22em] text-ink-500 block font-medium">
                                Wilayah
                            </span>
                            <h3 id="drawer-regency" class="font-serif text-xl sm:text-2xl font-bold text-ink-950 mt-1 leading-snug">
                                Nama Wilayah
                            </h3>
                            <div id="drawer-count" class="text-xs text-ink-600 mt-1.5 font-light">
                                0 tuturan terekam di tanah ini
                            </div>
                        </div>
                        <button id="drawer-close-btn" 
                                type="button" 
                                class="text-ink-500 hover:text-ink-950 p-2 min-w-[44px] min-h-[44px] flex items-center justify-center border border-transparent hover:border-linen-300 transition-colors focus:outline-none focus-visible:ring-1 focus-visible:ring-ink-900 cursor-pointer" 
                                aria-label="Tutup Panel">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Drawer Items List (Scrollable) -->
                    <div id="drawer-items-list" class="flex-1 min-h-0 overflow-y-auto p-5 sm:p-6 space-y-3 scrollbar-thin scrollbar-thumb-linen-300 overscroll-contain">
                        <!-- Populated by JavaScript -->
                    </div>

                    <!-- Drawer Footer Link -->
                    <div class="p-4 sm:p-5 border-t border-linen-300 bg-linen-100/50 mt-auto flex-shrink-0">
                        <a id="drawer-province-link" href="#" class="text-xs uppercase tracking-[0.18em] text-ink-700 hover:text-ink-950 inline-flex items-center justify-between w-full font-medium group transition-colors min-h-[36px]">
                            <span id="drawer-province-link-text">Buka Seluruh Arsip Provinsi &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. CURATED VOICES SHOWCASE [DARK: Obsidian #121110 with Ambient Exhibition Spotlight] -->
    <section id="arsip" class="relative py-12 sm:py-16 md:py-20 bg-obsidian-900 text-ink-100 border-b border-obsidian-700 overflow-hidden">
        <!-- Subtle Ambient Spotlight (Matches Hero Section Aura, Behind Cards) -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_85%_70%_at_50%_45%,_#221e1a_0%,_#171513_40%,_#121110_75%,_#090908_100%)] pointer-events-none"></div>
        <div class="absolute top-[50%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] sm:w-[1000px] h-[350px] sm:h-[450px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.05)_0%,_rgba(180,165,150,0.025)_45%,_transparent_70%)] blur-[80px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Section Header -->
            <div class="flex items-end justify-between mb-10 sm:mb-12 pb-4 sm:pb-5 border-b border-obsidian-700 gap-4">
                <div>
                    <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-1.5 sm:mb-2 font-medium">
                        Pilihan Kuratorial
                    </span>
                    <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-100">
                        Rekaman Pilihan
                    </h2>
                </div>
                <!-- Option A: Kinetic Fine-Line Horizontal Vector -->
                <a href="{{ route('arsip.index') }}" class="text-xs uppercase tracking-[0.15em] sm:tracking-[0.2em] text-ink-300 hover:text-ink-100 inline-flex items-center space-x-1.5 sm:space-x-2 group transition-colors font-medium shrink-0 pb-1">
                    <span class="hidden sm:inline">Lihat Seluruh Katalog</span>
                    <span class="sm:hidden">Katalog</span>
                    <svg class="w-3.5 h-3.5 text-ink-400 group-hover:text-ink-100 transition-transform duration-300 ease-out group-hover:translate-x-1.5 shrink-0" 
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>

            <!-- Cards Grid (Mounted on Peat Obsidian Surface) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse($featuredItems as $item)
                    <a href="{{ route('arsip.show', $item->slug) }}" class="group bg-obsidian-850 hover:bg-obsidian-800 border border-obsidian-700 transition-all duration-300 ease-out flex flex-col shadow-lg hover:shadow-2xl hover:shadow-black/90 hover:-translate-y-1.5 cursor-pointer focus:outline-none focus:ring-1 focus:ring-ink-200">
                        <!-- Thumbnail Wrapper with Grayscale Filter (Reveals Color on Hover) -->
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

                            <!-- Audio Indicator Overlay (Optically Balanced Play Icon) -->
                            <div class="absolute bottom-4 right-4 w-9 h-9 rounded-full bg-obsidian-950/80 border border-ink-100/30 flex items-center justify-center text-ink-100 group-hover:bg-ink-100 group-hover:text-obsidian-950 transition-colors duration-300 shadow-md">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                    <polygon points="6 3 20 12 6 21" />
                                </svg>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 sm:p-8 flex flex-col flex-grow">
                            <!-- Location with comma separator -->
                            <div class="text-xs uppercase tracking-[0.2em] text-ink-400 mb-2 font-medium">
                                {{ $item->regency->name }}, {{ $item->regency->province->name }}
                            </div>

                            <!-- Title -->
                            <h3 class="font-serif text-lg sm:text-xl font-bold text-ink-100 mb-3 group-hover:text-ink-200 transition-colors leading-snug">
                                {{ $item->title }}
                            </h3>

                            <!-- Excerpt (2-line clamp for uniform architectural card height) -->
                            <p class="text-ink-300 text-xs sm:text-sm leading-relaxed mb-6 font-light line-clamp-2">
                                {{ $item->excerpt ?? Str::limit(strip_tags($item->description), 130) }}
                            </p>

                            <!-- Footer link with Option B: Archival Specimen Diagonal Vector -->
                            <div class="mt-auto pt-4 border-t border-obsidian-700 flex items-center justify-between text-xs uppercase tracking-[0.2em] text-ink-300 font-medium">
                                <span class="group-hover:text-ink-100 transition-colors">Dengarkan Rekaman</span>
                                <svg class="w-3.5 h-3.5 text-ink-400 group-hover:text-ink-100 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-300 ease-out" 
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-16 border border-dashed border-obsidian-700 text-ink-400 text-sm">
                        Belum ada arsip yang dipublikasikan
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 4. EDITORIAL MANIFESTO [LIGHT: Unbleached Linen #F8F5F0] -->
    <section id="tentang" class="py-14 sm:py-16 md:py-20 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center space-y-5 sm:space-y-6">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block font-medium">
                Catatan Pengarsipan
            </span>
            <blockquote class="font-serif text-2xl sm:text-3xl md:text-4xl text-ink-900 font-medium italic leading-relaxed">
                &ldquo;Batu dan naskah bisa lapuk, tetapi bunyi yang dirawat dalam ingatan lisan akan melintasi masa dan terus menuturkan asal-usul kita.&rdquo;
            </blockquote>
            <p class="text-ink-600 text-xs sm:text-sm leading-relaxed max-w-2xl mx-auto font-light">
                Budaya Tutur hadir sebagai ruang simpan digital independen. Kami memprioritaskan tuturan lisan dari komunitas yang belum banyak terdokumentasi, menyajikannya secara khidmat tanpa komersialisasi.
            </p>
            <div class="pt-2 sm:pt-3">
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
        drawerCount.textContent = `${regency.culture_items.length} rekaman tersimpan dari wilayah ini:`;

        let listHtml = '';
        regency.culture_items.forEach(function (item) {
            const url = "{{ url('/arsip') }}/" + item.slug;
            listHtml += `
                <a href="${url}" class="group block p-4 bg-linen-100/70 border border-linen-300 hover:border-ink-900 hover:bg-linen-50 transition-all duration-200 shadow-sm focus:outline-none focus:border-ink-900">
                    <div class="flex items-start justify-between gap-3">
                        <h4 class="font-serif text-base sm:text-lg font-bold text-ink-950 group-hover:text-ink-900 leading-snug">
                            ${item.title}
                        </h4>
                        <div class="flex-shrink-0 mt-0.5 text-ink-400 group-hover:text-ink-900 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-[11px] text-ink-600 flex items-center space-x-1.5 font-sans">
                        <svg class="w-3 h-3 text-ink-500 group-hover:text-ink-900 transition-colors" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <span class="group-hover:text-ink-900 transition-colors font-medium tracking-wide">Dengarkan rekaman</span>
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

        // Archival Hover Tooltip
        marker.bindTooltip(`
            <div class="text-left font-sans">
                <span class="font-serif font-bold text-ink-950 block text-xs leading-tight">${regency.name}</span>
                <span class="text-[10px] text-ink-500 block uppercase tracking-wider mt-0.5">${itemCount} tuturan tersimpan</span>
            </div>
        `, {
            direction: 'top',
            offset: [0, -anchor - 4],
            className: 'archival-marker-tooltip',
            opacity: 1
        });

        marker.on('click', function (e) {
            if (e.originalEvent) {
                e.originalEvent.stopPropagation();
            }
            activeMarker = marker;
            const markerEl = marker._icon ? marker._icon.querySelector('.custom-sound-marker') : null;
            
            // Smart auto-pan: offset so marker is centered in unobscured map area
            const targetZoom = Math.max(map.getZoom(), 7);
            const isDesktop = window.innerWidth >= 640;
            const offsetX = isDesktop ? 192 : 0;
            const offsetY = isDesktop ? 0 : 130;

            const markerPoint = map.project(latLng, targetZoom);
            const targetPoint = new L.Point(markerPoint.x + offsetX, markerPoint.y + offsetY);
            const targetLatLng = map.unproject(targetPoint, targetZoom);

            map.flyTo(targetLatLng, targetZoom, { duration: 0.8 });
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
