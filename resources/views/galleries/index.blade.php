@extends('layouts.app')

@section('title', 'Katalog Arsip Suara & Tradisi Lisan — Budaya Tutur Voices')
@section('meta_description', 'Jelajahi seluruh kumpulan rekaman suara, nyanyian adat, mantra, dan tuturan lisan nusantara.')

@section('content')
    <!-- Header Banner [DARK: Obsidian #121110] -->
    <header class="bg-obsidian-900 border-b border-obsidian-700 py-16 sm:py-24 text-ink-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <span class="text-[11px] uppercase tracking-[0.3em] text-ink-400 block mb-3 font-medium">
                Katalog Digital
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold tracking-tight text-ink-100 uppercase mb-4">
                Arsip Suara Nusantara
            </h1>
            <p class="text-ink-300 text-sm sm:text-base font-light max-w-2xl leading-relaxed">
                Koleksi bunyi, kidung, dan cerita lisan yang dihimpun dari berbagai penjuru tanah adat. Telusuri berdasarkan wilayah administratif atau ragam tutur.
            </p>
        </div>
    </header>

    <!-- Filter & Search Toolbar [DARK COMPACT: Obsidian #161413] -->
    <section class="bg-obsidian-850/95 border-b border-obsidian-700 sticky top-20 z-30 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-5">
            <form action="{{ route('galleries.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                <!-- Search Keyword -->
                <div class="sm:col-span-5 relative">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Cari judul, daerah, atau kata kunci..." 
                           class="w-full bg-obsidian-900 border border-obsidian-700 focus:border-ink-100 text-ink-100 text-xs px-4 py-3 tracking-wide placeholder-ink-500 focus:outline-none transition-colors">
                </div>

                <!-- Province Filter -->
                <div class="sm:col-span-3">
                    <select name="province" 
                            onchange="this.form.submit()" 
                            class="w-full bg-obsidian-900 border border-obsidian-700 focus:border-ink-100 text-ink-100 text-xs px-4 py-3 tracking-wide focus:outline-none transition-colors">
                        <option value="">Semua Provinsi</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov->slug }}" {{ request('province') === $prov->slug ? 'selected' : '' }}>
                                {{ $prov->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="sm:col-span-3">
                    <select name="category" 
                            onchange="this.form.submit()" 
                            class="w-full bg-obsidian-900 border border-obsidian-700 focus:border-ink-100 text-ink-100 text-xs px-4 py-3 tracking-wide focus:outline-none transition-colors">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Reset / Submit -->
                <div class="sm:col-span-1 flex justify-end">
                    @if(request()->hasAny(['q', 'province', 'category']))
                        <a href="{{ route('galleries.index') }}" 
                           class="w-full text-center py-3 border border-obsidian-700 text-[11px] uppercase tracking-wider text-ink-300 hover:text-ink-100 hover:border-ink-100 transition-colors">
                            Atur Ulang
                        </a>
                    @else
                        <button type="submit" class="w-full py-3 bg-ink-100 text-obsidian-950 text-xs uppercase tracking-wider font-semibold hover:bg-linen-200 transition-colors">
                            Cari
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Archive Grid Section [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-16 sm:py-24 bg-linen-100 text-ink-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Results Counter -->
            <div class="mb-10 text-xs uppercase tracking-[0.2em] text-ink-500 font-medium">
                Menampilkan {{ $items->total() }} rekaman tutur
                @if(request('q')) untuk &ldquo;{{ request('q') }}&rdquo; @endif
            </div>

            <!-- Grid of Cards (Linen Mount) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse($items as $item)
                    <article class="group bg-linen-50 border border-linen-300 hover:border-ink-800 transition-all duration-300 flex flex-col shadow-sm">
                        <!-- Thumbnail Wrapper -->
                        <a href="{{ route('galleries.show', $item->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-linen-200">
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
                            
                            @if($item->category)
                                <div class="absolute top-4 left-4 bg-linen-100/90 backdrop-blur-sm border border-linen-300 px-2.5 py-1 text-[10px] uppercase tracking-[0.2em] text-ink-800 font-medium">
                                    {{ $item->category }}
                                </div>
                            @endif

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
                                <a href="{{ route('galleries.show', $item->slug) }}">
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
                    <div class="col-span-3 text-center py-24 border border-dashed border-linen-400 p-8 space-y-4">
                        <p class="font-serif text-lg text-ink-900 font-medium">Tidak ada rekaman yang sesuai dengan penyaringan.</p>
                        <p class="text-xs text-ink-500 font-light">Coba cari dengan kata kunci lain atau ubah pilihan filter wilayah.</p>
                        <div class="pt-4">
                            <a href="{{ route('galleries.index') }}" class="inline-block px-6 py-2.5 border border-ink-900 text-xs uppercase tracking-[0.2em] text-ink-900 hover:bg-ink-900 hover:text-linen-100 transition-colors font-medium">
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
    </section>
@endsection
