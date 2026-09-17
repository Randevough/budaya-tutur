@extends('layouts.app')

@section('title', 'Katalog Arsip Suara & Tradisi Lisan — Budaya Tutur Voices')
@section('meta_description', 'Jelajahi seluruh kumpulan rekaman suara, nyanyian adat, mantra, dan tuturan lisan nusantara.')

@section('content')
    <!-- Header Banner [DARK: Obsidian #121110] -->
    <header class="bg-obsidian-900 border-b border-obsidian-700 py-16 sm:py-20 text-ink-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <span class="text-[11px] uppercase tracking-[0.3em] text-ink-400 block mb-3 font-medium">
                Katalog Digital
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold tracking-tight text-ink-100 uppercase mb-4">
                Arsip Suara Nusantara
            </h1>
            <p class="text-ink-300 text-sm sm:text-base font-light max-w-2xl leading-relaxed">
                Koleksi bunyi, kidung, dan cerita lisan yang dihimpun dari berbagai penjuru tanah adat. Telusuri berdasarkan wilayah administratif atau ragam tutur secara langsung.
            </p>
        </div>
    </header>

    <!-- Filter & Search Toolbar [DARK COMPACT: Obsidian #161413] -->
    <section class="bg-obsidian-850/95 border-b border-obsidian-700 sticky top-20 z-30 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 sm:py-5">
            <form id="archive-filter-form" action="{{ route('arsip.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-center">
                <!-- Search Keyword -->
                <div class="sm:col-span-8 relative flex items-center">
                    <div class="absolute left-3.5 text-ink-500 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 21l-4.35-4.35" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <input type="text" 
                           id="search-input"
                           name="q" 
                           value="{{ request('q') }}" 
                           autocomplete="off"
                           placeholder="Ketik judul, daerah, provinsi, atau kata kunci..." 
                           class="w-full bg-obsidian-900 border border-obsidian-700 focus:border-ink-100 text-ink-100 text-xs pl-10 pr-10 py-3 tracking-wide placeholder-ink-500 focus:outline-none transition-colors">
                    <button type="button" 
                            id="search-clear-btn" 
                            class="absolute right-3.5 text-ink-500 hover:text-ink-100 text-base leading-none transition-colors {{ request('q') ? '' : 'hidden' }}"
                            aria-label="Bersihkan pencarian">
                        &times;
                    </button>
                </div>

                <!-- Province Filter & Reset -->
                <div class="sm:col-span-4 flex items-center space-x-3">
                    <div class="relative w-full">
                        <select id="province-select" 
                                name="province" 
                                class="w-full appearance-none bg-obsidian-900 border border-obsidian-700 focus:border-ink-100 text-ink-100 text-xs pl-4 pr-9 py-3 tracking-wide focus:outline-none transition-colors cursor-pointer">
                            <option value="">Semua Wilayah Provinsi</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->slug }}" {{ request('province') === $prov->slug ? 'selected' : '' }}>
                                    {{ $prov->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-ink-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('arsip.index') }}" 
                       id="filter-reset-btn"
                       class="shrink-0 px-4 py-3 border border-obsidian-700 hover:border-ink-100 text-[11px] uppercase tracking-wider text-ink-400 hover:text-ink-100 hover:bg-obsidian-800 transition-colors {{ request()->hasAny(['q', 'province']) ? '' : 'hidden' }}"
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
                <div id="results-counter" class="text-xs uppercase tracking-[0.2em] text-ink-500 font-medium">
                    Menampilkan {{ $items->total() }} rekaman tutur
                    @if(request('q')) untuk &ldquo;{{ request('q') }}&rdquo; @endif
                    @if(request('province')) &bull; {{ $provinces->firstWhere('slug', request('province'))->name ?? request('province') }} @endif
                </div>

                <div id="search-spinner" class="hidden items-center space-x-2 text-[11px] uppercase tracking-widest text-ink-500">
                    <svg class="animate-spin h-3.5 w-3.5 text-ink-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Memperbarui...</span>
                </div>
            </div>

            <!-- Grid Container with Smooth Transition -->
            <div id="archive-grid-container" class="transition-opacity duration-200">
                <!-- Grid of Cards (Linen Mount) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                    @forelse($items as $item)
                        <article class="group bg-linen-50 border border-linen-300 hover:border-ink-800 transition-all duration-300 flex flex-col shadow-sm">
                            <!-- Thumbnail Wrapper -->
                            <a href="{{ route('arsip.show', $item->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-linen-200">
                                @if($item->thumbnail_url)
                                    <img src="{{ $item->thumbnail_url }}" 
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover grayscale contrast-110 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-700 ease-out"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-linen-200 text-ink-500 text-xs uppercase tracking-widest">
                                        Rekaman Budaya
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-obsidian-950/80 via-transparent to-transparent"></div>

                                <div class="absolute bottom-4 right-4 w-9 h-9 rounded-full bg-obsidian-950/70 border border-ink-100/30 flex items-center justify-center text-ink-100 group-hover:bg-ink-900 group-hover:text-linen-100 transition-colors duration-300">
                                    <svg class="w-4 h-4 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </a>

                            <!-- Card Details -->
                            <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                <div class="text-[11px] uppercase tracking-[0.2em] text-ink-500 mb-2 font-medium">
                                    {{ $item->regency->name }}, {{ $item->regency->province->name }}
                                </div>

                                <h2 class="font-serif text-lg sm:text-xl font-bold text-ink-900 mb-3 group-hover:text-ink-700 transition-colors leading-snug">
                                    <a href="{{ route('arsip.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h2>

                                <p class="text-ink-600 text-xs sm:text-sm leading-relaxed mb-6 font-light line-clamp-3">
                                    {{ $item->excerpt ?? Str::limit(strip_tags($item->description), 140) }}
                                </p>

                                <div class="mt-auto pt-4 border-t border-linen-300 flex items-center justify-between text-[11px] uppercase tracking-[0.2em] text-ink-700 font-medium">
                                    <span class="group-hover:text-ink-900 transition-colors">Dengar Rekaman</span>
                                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 border border-dashed border-linen-400 p-8 space-y-4">
                            <p class="font-serif text-lg text-ink-900 font-medium">Tidak ada rekaman yang sesuai dengan penyaringan.</p>
                            <p class="text-xs text-ink-500 font-light">Coba cari dengan kata kunci lain atau ubah pilihan filter wilayah.</p>
                            <div class="pt-4">
                                <a href="{{ route('arsip.index') }}" class="inline-block px-6 py-2.5 border border-ink-900 text-xs uppercase tracking-[0.2em] text-ink-900 hover:bg-ink-900 hover:text-linen-100 transition-colors font-medium">
                                    Lihat Semua Rekaman
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="mt-16">
                    {{ $items->links() }}
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

    if (!form || !searchInput || !provinceSelect || !gridContainer) return;

    let debounceTimer = null;
    let abortController = null;

    const performSearch = (targetUrl = null) => {
        if (abortController) {
            abortController.abort();
        }
        abortController = new AbortController();

        const url = targetUrl || `${form.getAttribute('action')}?${new URLSearchParams(new FormData(form)).toString()}`;

        // Toggle reset button & clear button visibility
        const qVal = searchInput.value.trim();
        const provVal = provinceSelect.value;
        if (clearBtn) {
            clearBtn.classList.toggle('hidden', !qVal);
        }
        if (resetBtn) {
            resetBtn.classList.toggle('hidden', !qVal && !provVal);
        }

        // Loading state
        if (spinnerEl) spinnerEl.classList.remove('hidden');
        gridContainer.classList.add('opacity-40', 'pointer-events-none');

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
            gridContainer.classList.remove('opacity-40', 'pointer-events-none');
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

    // Instant filter on province selection
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
});
</script>
@endpush
