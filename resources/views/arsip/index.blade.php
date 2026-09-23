@extends('layouts.app')

@section('title', 'Katalog Arsip Suara Nusantara | Budaya Tutur')
@section('meta_description', 'Kumpulan rekaman suara, kidung, dan cerita lisan langsung dari penutur di berbagai daerah nusantara.')

@section('content')
    <!-- Header Banner [DARK: Obsidian #121110 with Ambient Spotlight] -->
    <header class="relative bg-obsidian-900 border-b border-obsidian-700 py-16 sm:py-24 text-ink-100 overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_35%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] sm:w-[950px] h-[340px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-3 font-medium">
                Katalog Digital
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-ink-100 uppercase mb-4 leading-[1.15]">
                Arsip Suara Nusantara
            </h1>
            <p class="text-ink-300 text-sm sm:text-base md:text-lg font-light max-w-2xl leading-relaxed">
                Rekaman audio, kidung, dan cerita lisan langsung dari penutur di berbagai daerah. Cari lewat kata kunci atau saring berdasarkan provinsi.
            </p>
        </div>
    </header>

    <!-- Filter & Search Toolbar [DARK COMPACT: Obsidian #161413] -->
    <section class="bg-obsidian-850/95 border-b border-obsidian-700 sticky top-20 z-30 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-2.5 sm:py-3.5">
            <form id="archive-filter-form" action="{{ route('arsip.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-2.5 sm:gap-3 items-center">
                <input type="hidden" name="per_page" id="per_page_input" value="{{ $items->perPage() }}">
                <!-- Search Keyword -->
                <div class="sm:col-span-8 relative flex items-center">
                    <div class="absolute left-3.5 text-ink-400 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="11" cy="11" r="8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 21l-4.35-4.35" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <input type="text" 
                           id="search-input" 
                           name="q" 
                           value="{{ request('q') }}" 
                           autocomplete="off" 
                           placeholder="Ketik judul, daerah, provinsi, atau kata kunci..." 
                           aria-label="Cari arsip budaya tutur"
                           class="w-full bg-obsidian-900 border border-obsidian-700 hover:border-obsidian-600 focus:border-ink-200 focus:bg-obsidian-950 text-ink-100 text-base sm:text-sm pl-10 pr-11 py-2.5 sm:py-3 tracking-normal placeholder-ink-400 focus:outline-none transition-all duration-200 shadow-inner">
                    <button type="button" 
                            id="search-clear-btn" 
                            class="absolute right-2 sm:right-2.5 w-9 h-9 sm:w-8 sm:h-8 flex items-center justify-center rounded-full text-ink-400 hover:text-ink-100 hover:bg-obsidian-800 transition-all min-w-[36px] min-h-[36px] cursor-pointer {{ request('q') ? '' : 'hidden' }}" 
                            aria-label="Bersihkan pencarian">
                        <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Province Filter & Reset -->
                <div class="sm:col-span-4 flex items-center space-x-2.5">
                    <div class="relative w-full" id="province-dropdown-wrapper">
                        <!-- Hidden native select for standard form submit & query string binding -->
                        <select id="province-select" name="province" class="sr-only" aria-label="Pilih Provinsi">
                            <option value="">Semua Wilayah Provinsi</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->slug }}" {{ request('province') === $prov->slug ? 'selected' : '' }}>
                                    {{ $prov->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Custom Dropdown Trigger Button (min 44px height) -->
                        <button type="button" 
                                id="province-dropdown-btn" 
                                aria-haspopup="listbox" 
                                aria-expanded="false" 
                                aria-label="Saring menurut wilayah provinsi"
                                class="w-full min-h-[44px] flex items-center justify-between bg-obsidian-900 border border-obsidian-700 hover:border-obsidian-600 focus:border-ink-200 focus:bg-obsidian-950 text-ink-100 text-xs sm:text-sm pl-3.5 sm:pl-4 pr-3 py-2.5 sm:py-3 tracking-normal focus:outline-none transition-all duration-200 text-left shadow-inner cursor-pointer">
                            <span id="province-dropdown-label" class="truncate font-light">
                                @php
                                    $selectedProv = $provinces->firstWhere('slug', request('province'));
                                @endphp
                                {{ $selectedProv ? $selectedProv->name : 'Semua Wilayah Provinsi' }}
                            </span>
                            <svg id="province-dropdown-icon" class="w-3.5 h-3.5 text-ink-400 shrink-0 ml-2 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Custom Dropdown Menu -->
                        <div id="province-dropdown-menu" 
                             role="listbox" 
                             tabindex="-1"
                             class="hidden absolute left-0 right-0 top-full mt-1.5 bg-obsidian-900 border border-obsidian-700 shadow-2xl z-50 max-h-60 overflow-y-auto divide-y divide-obsidian-800/80">
                            <div class="py-1">
                                <button type="button" 
                                        role="option" 
                                        tabindex="0"
                                        data-value="" 
                                        class="province-item w-full min-h-[44px] flex items-center justify-between text-left px-3.5 sm:px-4 py-2.5 text-xs sm:text-sm text-ink-200 hover:bg-obsidian-800 hover:text-ink-50 focus:bg-obsidian-800 focus:outline-none transition-colors cursor-pointer {{ !request('province') ? 'bg-obsidian-800/90 text-ink-100 font-medium' : 'font-light' }}">
                                    <span>Semua Wilayah Provinsi</span>
                                    <span class="province-check {{ !request('province') ? '' : 'hidden' }}">
                                        <svg class="w-3.5 h-3.5 text-ink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div class="py-1">
                                @foreach($provinces as $prov)
                                    <button type="button" 
                                            role="option" 
                                            tabindex="0"
                                            data-value="{{ $prov->slug }}" 
                                            class="province-item w-full min-h-[44px] flex items-center justify-between text-left px-3.5 sm:px-4 py-2.5 text-xs sm:text-sm text-ink-200 hover:bg-obsidian-800 hover:text-ink-50 focus:bg-obsidian-800 focus:outline-none transition-colors cursor-pointer {{ request('province') === $prov->slug ? 'bg-obsidian-800/90 text-ink-100 font-medium' : 'font-light' }}">
                                        <span>{{ $prov->name }}</span>
                                        <span class="province-check {{ request('province') === $prov->slug ? '' : 'hidden' }}">
                                            <svg class="w-3.5 h-3.5 text-ink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('arsip.index') }}" 
                       id="filter-reset-btn" 
                       class="shrink-0 min-h-[44px] px-4 py-2.5 sm:py-3 border border-obsidian-700 hover:border-ink-100 text-xs uppercase tracking-wider text-ink-300 hover:text-ink-100 hover:bg-obsidian-800 transition-colors font-medium flex items-center justify-center {{ request()->hasAny(['q', 'province']) ? '' : 'hidden' }}" 
                       title="Atur Ulang Pencarian">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- Archive Grid Section [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-14 sm:py-20 bg-linen-100 text-ink-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Results Counter & Live Indicator -->
            <div class="flex items-center justify-between mb-8">
                <div id="results-counter" class="text-xs sm:text-sm uppercase tracking-[0.18em] text-ink-500 font-medium">
                    Menampilkan {{ $items->total() }} rekaman tutur
                    @if(request('q')) untuk &ldquo;{{ request('q') }}&rdquo; @endif
                    @if(request('province')) &bull; {{ $provinces->firstWhere('slug', request('province'))->name ?? request('province') }} @endif
                </div>

                <div id="search-spinner" class="hidden items-center space-x-2 text-xs uppercase tracking-widest text-ink-500">
                    <svg class="animate-spin h-3.5 w-3.5 text-ink-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Memperbarui...</span>
                </div>
            </div>

            <!-- Skeleton Loading Grid (shown during AJAX fetch) -->
            <div id="archive-skeleton-grid" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                    @for($i = 0; $i < ($items->perPage() ?: 9); $i++)
                        <div class="bg-linen-50 border border-linen-300 flex flex-col shadow-sm animate-pulse pointer-events-none" aria-hidden="true">
                            <div class="aspect-video bg-linen-200 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-linen-100/40 to-transparent -translate-x-full animate-[shimmer_1.5s_infinite]"></div>
                                <div class="absolute bottom-3.5 right-3.5 w-10 h-10 rounded-full bg-linen-300/80"></div>
                            </div>
                            <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                <div class="h-3 w-1/2 bg-linen-200 mb-3"></div>
                                <div class="h-5 w-4/5 bg-linen-300 mb-4"></div>
                                <div class="space-y-2 mb-6">
                                    <div class="h-3 w-full bg-linen-200"></div>
                                    <div class="h-3 w-5/6 bg-linen-200"></div>
                                </div>
                                <div class="mt-auto pt-4 border-t border-linen-300 flex items-center justify-between">
                                    <div class="h-3 w-28 bg-linen-200"></div>
                                    <div class="h-3.5 w-3.5 bg-linen-200"></div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Grid Container with Smooth Transition -->
            <div id="archive-grid-container" class="transition-opacity duration-200">
                <!-- Grid of Cards (Linen Mount) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                    @forelse($items as $item)
                        <a href="{{ route('arsip.show', $item->slug) }}" class="group bg-linen-50 border border-linen-300 hover:border-ink-800 transition-all duration-300 flex flex-col shadow-sm cursor-pointer focus:outline-none focus:ring-1 focus:ring-ink-800">
                            <!-- Thumbnail Wrapper (16:9 standard video aspect) -->
                            <div class="relative block aspect-video overflow-hidden bg-linen-200">
                                @if($item->thumbnail_url)
                                    <img src="{{ $item->thumbnail_url }}" 
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover grayscale contrast-110 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-700 ease-out"
                                         loading="lazy"
                                         decoding="async"
                                         width="640"
                                         height="360"
                                         onerror="this.src='https://img.youtube.com/vi/{{ $item->youtube_id }}/hqdefault.jpg'">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-linen-200 text-ink-500 text-xs uppercase tracking-widest">
                                        Rekaman Budaya
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-obsidian-950/80 via-transparent to-transparent"></div>

                                <!-- Optically Center-Aligned Play Button -->
                                <div class="absolute bottom-3.5 right-3.5 w-10 h-10 rounded-full bg-obsidian-950/75 backdrop-blur-sm border border-linen-100/30 flex items-center justify-center text-ink-100 group-hover:bg-ink-900 group-hover:text-linen-100 group-hover:scale-105 transition-all duration-300 shadow-md">
                                    <svg class="w-4 h-4 text-ink-100" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <polygon points="9,6 18,12 9,18"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Card Details -->
                            <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                <div class="text-xs uppercase tracking-[0.2em] text-ink-600 mb-2 font-medium">
                                    {{ $item->regency->name }}, {{ $item->regency->province->name }}
                                </div>

                                <h2 class="font-serif text-lg sm:text-xl font-bold text-ink-900 mb-3 group-hover:text-ink-700 transition-colors leading-snug">
                                    {{ $item->title }}
                                </h2>

                                <p class="text-ink-600 text-xs sm:text-sm leading-relaxed mb-6 font-light line-clamp-3">
                                    {{ $item->excerpt ?? Str::limit(strip_tags($item->description), 140) }}
                                </p>

                                <div class="mt-auto pt-4 border-t border-linen-300 flex items-center justify-between text-xs uppercase tracking-[0.2em] text-ink-700 font-medium">
                                    <span class="group-hover:text-ink-900 transition-colors">Dengar Rekaman</span>
                                    <svg class="w-4 h-4 text-ink-700 group-hover:text-ink-950 transform group-hover:translate-x-1.5 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 border border-dashed border-linen-400 p-8 sm:p-12 w-full space-y-4">
                            <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink-900 uppercase tracking-tight">
                                Tidak ada rekaman yang cocok
                            </h3>
                            <p class="text-sm sm:text-base text-ink-600 font-light max-w-lg mx-auto leading-relaxed">
                                Coba cari dengan kata kunci lain atau kosongkan pilihan filter wilayah.
                            </p>
                            <div class="pt-4">
                                <a href="{{ route('arsip.index') }}" class="inline-block px-7 py-3 border border-ink-900 text-xs sm:text-sm uppercase tracking-[0.2em] text-ink-900 hover:bg-ink-900 hover:text-linen-100 transition-colors font-medium">
                                    Lihat Semua Rekaman
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Links (Centered Editorial Monochrome) -->
                <div class="mt-14 sm:mt-16 flex items-center justify-center max-w-full pb-2">
                    {{ $items->links('vendor.pagination.editorial') }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('archive-filter-form');
    const searchInput = document.getElementById('search-input');
    const clearBtn = document.getElementById('search-clear-btn');
    const provinceSelect = document.getElementById('province-select');
    const resetBtn = document.getElementById('filter-reset-btn');
    const counterEl = document.getElementById('results-counter');
    const spinnerEl = document.getElementById('search-spinner');
    const gridContainer = document.getElementById('archive-grid-container');
    const skeletonGrid = document.getElementById('archive-skeleton-grid');
    const perPageInput = document.getElementById('per_page_input');

    const getResponsivePerPage = () => window.innerWidth < 768 ? 6 : 9;

    const syncPerPage = () => {
        if (perPageInput) {
            perPageInput.value = getResponsivePerPage();
        }
    };

    // Custom dropdown elements
    const dropdownWrapper = document.getElementById('province-dropdown-wrapper');
    const dropdownBtn = document.getElementById('province-dropdown-btn');
    const dropdownMenu = document.getElementById('province-dropdown-menu');
    const dropdownLabel = document.getElementById('province-dropdown-label');
    const dropdownIcon = document.getElementById('province-dropdown-icon');
    const dropdownItems = document.querySelectorAll('.province-item');

    if (!form || !searchInput || !provinceSelect || !gridContainer) return;

    let debounceTimer = null;
    let abortController = null;

    const toggleDropdown = (show = null) => {
        if (!dropdownMenu) return;
        const isHidden = dropdownMenu.classList.contains('hidden');
        const shouldShow = show !== null ? show : isHidden;
        if (shouldShow) {
            dropdownMenu.classList.remove('hidden');
            if (dropdownIcon) dropdownIcon.classList.add('rotate-180');
            if (dropdownBtn) dropdownBtn.setAttribute('aria-expanded', 'true');
        } else {
            dropdownMenu.classList.add('hidden');
            if (dropdownIcon) dropdownIcon.classList.remove('rotate-180');
            if (dropdownBtn) dropdownBtn.setAttribute('aria-expanded', 'false');
        }
    };

    if (dropdownBtn && dropdownMenu) {
        dropdownBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            toggleDropdown();
        });

        // Keyboard navigation for dropdown button
        dropdownBtn.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown' || e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleDropdown(true);
                const firstOption = dropdownMenu.querySelector('.province-item');
                if (firstOption) firstOption.focus();
            }
        });

        // Keyboard navigation inside dropdown options
        dropdownMenu.addEventListener('keydown', (e) => {
            const items = Array.from(dropdownMenu.querySelectorAll('.province-item'));
            const activeIndex = items.indexOf(document.activeElement);

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const nextIndex = (activeIndex + 1) % items.length;
                items[nextIndex].focus();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prevIndex = (activeIndex - 1 + items.length) % items.length;
                items[prevIndex].focus();
            } else if (e.key === 'Escape') {
                e.preventDefault();
                toggleDropdown(false);
                dropdownBtn.focus();
            } else if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                if (document.activeElement && document.activeElement.classList.contains('province-item')) {
                    document.activeElement.click();
                    dropdownBtn.focus();
                }
            }
        });

        dropdownItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const val = item.getAttribute('data-value');
                const text = item.querySelector('span:first-child').textContent.trim();

                provinceSelect.value = val;
                if (dropdownLabel) dropdownLabel.textContent = text;

                dropdownItems.forEach(i => {
                    const isSelected = i === item;
                    i.classList.toggle('bg-obsidian-800/90', isSelected);
                    i.classList.toggle('text-ink-100', isSelected);
                    i.classList.toggle('font-medium', isSelected);
                    i.classList.toggle('font-light', !isSelected);
                    const check = i.querySelector('.province-check');
                    if (check) check.classList.toggle('hidden', !isSelected);
                });

                toggleDropdown(false);
                performSearch();
            });
        });

        // Close on click outside
        document.addEventListener('click', (e) => {
            if (dropdownWrapper && !dropdownWrapper.contains(e.target)) {
                toggleDropdown(false);
            }
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !dropdownMenu.classList.contains('hidden')) {
                toggleDropdown(false);
                dropdownBtn.focus();
            }
        });
    }

    const performSearch = (targetUrl = null) => {
        if (abortController) {
            abortController.abort();
        }
        abortController = new AbortController();

        const targetPerPage = getResponsivePerPage();
        syncPerPage();

        let url;
        if (targetUrl) {
            const parsedUrl = new URL(targetUrl, window.location.origin);
            // Always enforce per_page to match current viewport
            parsedUrl.searchParams.set('per_page', targetPerPage);
            url = parsedUrl.toString();
        } else {
            const formData = new FormData(form);
            formData.set('per_page', targetPerPage);
            url = `${form.getAttribute('action')}?${new URLSearchParams(formData).toString()}`;
        }

        // Toggle reset button & clear button visibility
        const qVal = searchInput.value.trim();
        const provVal = provinceSelect.value;
        if (clearBtn) {
            clearBtn.classList.toggle('hidden', !qVal);
        }
        if (resetBtn) {
            resetBtn.classList.toggle('hidden', !qVal && !provVal);
        }

        // Loading state with Skeleton UI
        if (spinnerEl) spinnerEl.classList.remove('hidden');
        if (skeletonGrid) skeletonGrid.classList.remove('hidden');
        if (gridContainer) gridContainer.classList.add('hidden');

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            signal: abortController.signal
        })
        .then(response => {
            if (!response.ok) throw new Error('Search request failed');
            return response.text();
        })
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newCounter = doc.getElementById('results-counter');
            const newGrid = doc.getElementById('archive-grid-container');

            if (newCounter && counterEl) {
                counterEl.innerHTML = newCounter.innerHTML;
            }
            if (newGrid && gridContainer) {
                gridContainer.innerHTML = newGrid.innerHTML;
            }

            // Sync URL bar without full page reload
            window.history.replaceState(null, '', url);

            // Rebind pagination links in newly rendered DOM
            bindPaginationLinks();
        })
        .catch(err => {
            if (err.name !== 'AbortError') {
                console.error('Error fetching search results:', err);
            }
        })
        .finally(() => {
            if (spinnerEl) spinnerEl.classList.add('hidden');
            if (skeletonGrid) skeletonGrid.classList.add('hidden');
            if (gridContainer) gridContainer.classList.remove('hidden');
        });
    };

    const bindPaginationLinks = () => {
        gridContainer.querySelectorAll('nav[role="navigation"] a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                performSearch(link.getAttribute('href'));
                window.scrollTo({ top: form.offsetTop - 100, behavior: 'smooth' });
            });
        });
    };

    // Live search input with 300ms debouncing
    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            performSearch();
        }, 300);
    });

    // Instant filter on province selection (if changed programmatically)
    provinceSelect.addEventListener('change', () => {
        performSearch();
    });

    // Clear search input
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
            clearBtn.classList.add('hidden');
            performSearch();
            searchInput.focus();
        });
    }

    // Reset button AJAX click
    if (resetBtn) {
        resetBtn.addEventListener('click', (e) => {
            e.preventDefault();
            searchInput.value = '';
            provinceSelect.value = '';
            if (dropdownLabel) dropdownLabel.textContent = 'Semua Wilayah Provinsi';
            dropdownItems.forEach(i => {
                const isDefault = i.getAttribute('data-value') === '';
                i.classList.toggle('bg-obsidian-800/90', isDefault);
                i.classList.toggle('text-ink-100', isDefault);
                i.classList.toggle('font-medium', isDefault);
                i.classList.toggle('font-light', !isDefault);
                const check = i.querySelector('.province-check');
                if (check) check.classList.toggle('hidden', !isDefault);
            });
            performSearch(resetBtn.getAttribute('href'));
        });
    }

    // Prevent manual Enter from causing full reload
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        performSearch();
    });

    // Initial pagination link binding
    bindPaginationLinks();

    // Client viewport check: ensure cards count strictly matches active viewport width (6 mobile, 9 desktop)
    const currentPerPageParam = new URLSearchParams(window.location.search).get('per_page');
    const targetPerPage = getResponsivePerPage();
    if (currentPerPageParam && parseInt(currentPerPageParam) !== targetPerPage) {
        syncPerPage();
        performSearch();
    } else if (!currentPerPageParam && {{ $items->perPage() }} !== targetPerPage) {
        syncPerPage();
        performSearch();
    }
});
</script>
@endpush
