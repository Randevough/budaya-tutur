@extends('layouts.app')

@section('title', 'Tentang — Budaya Tutur Voices')

@section('content')
    <!-- 1. EDITORIAL HERO SECTION [DARK: Obsidian #121110 Velvet] -->
    <section class="relative bg-obsidian-900 border-b border-obsidian-700 py-16 sm:py-24 overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_35%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] sm:w-[950px] h-[340px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-8">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-3 font-medium">
                Manifesto & Identitas
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-ink-100 leading-[1.15] uppercase mb-4 sm:mb-6">
                Menjaga Tutur,<br class="hidden sm:inline"> Merawat Ingatan Kolektif
            </h1>
            <p class="text-ink-300 text-sm sm:text-base md:text-lg max-w-2xl font-light leading-relaxed">
                Budaya Tutur Voices adalah inisiatif pengarsipan digital mandiri yang didedikasikan untuk merekam, menyelamatkan, dan membuka akses terhadap sastra lisan, kidung ritual, mitos asal-usul, dan suara penutur asli dari berbagai pelosok kepulauan nusantara
            </p>
        </div>
    </section>

    <!-- 2. PROFIL & LATAR BELAKANG [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-16 sm:py-24 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                <!-- Left Column: Section Marker -->
                <div class="lg:col-span-4 space-y-4">
                    <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block font-medium">
                        Latar Belakang
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold uppercase tracking-tight text-ink-900">
                        Ketika Suara Terancam Senyap
                    </h2>
                </div>

                <!-- Right Column: Narrative Body -->
                <div class="lg:col-span-8 space-y-6 text-sm sm:text-base text-ink-700 font-light leading-relaxed">
                    <p>
                        Sebagian besar pengetahuan leluhur di nusantara tidak diwariskan lewat lembaran kertas, melainkan melalui getaran suara: nyanyian panen para ibu di ladang, mantra penyembuhan tetua adat saat senja, kidung pelaut membaca navigasi bintang, hingga cerita pengantar tidur berima yang sarat filosofi hidup
                    </p>
                    <p>
                        Namun, arus modernisasi yang tergesa-gesa serta berkurangnya penutur generasi tua membuat ribuan tradisi lisan ini berada di ambang kepunahan. Ketika seorang penutur adat berpulang tanpa dokumentasi yang memadai, satu perpustakaan pengetahuan lisan ikut terkubur bersama kepergiannya
                    </p>
                    <p>
                        Kami hadir bukan sekadar untuk mencatat kata demi kata, melainkan menangkap nuansa asli tuturan: timbre suara, desah napas, intonasi emosional, dan hening di antara kalimat yang merupakan jiwa dari sastra tutur nusantara
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI [DARK: Obsidian #0C0B0A Charcoal] -->
    <section class="py-14 sm:py-20 bg-obsidian-950 text-ink-100 border-b border-obsidian-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Header -->
            <div class="max-w-3xl mb-8 sm:mb-10">
                <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-2 font-medium">
                    Arah & Komitmen
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-100">
                    Visi & Misi
                </h2>
            </div>

            <!-- Monumental Vision Plaque -->
            <div class="relative mb-10 sm:mb-12 p-5 sm:p-10 md:p-12 border border-obsidian-700/80 bg-obsidian-900/80 backdrop-blur-sm overflow-hidden shadow-2xl">
                <!-- Large Ambient Quote Mark Motif -->
                <span class="absolute -top-2 -left-1 sm:top-2 sm:left-4 font-serif text-6xl sm:text-8xl md:text-9xl text-obsidian-700/30 select-none pointer-events-none leading-none -z-0" aria-hidden="true">“</span>
                
                <!-- Subtle Radial PEAT Glow -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[220px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.04)_0%,_transparent_70%)] blur-[50px] pointer-events-none"></div>

                <div class="relative z-10">
                    <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-4 font-medium">
                        Visi Utama
                    </span>

                    <p class="font-serif text-xl sm:text-2xl md:text-3xl text-ink-100 leading-relaxed font-normal max-w-4xl mb-6">
                        "Menjadi rumah arsip digital terbuka paling tepercaya dan bermartabat bagi suara, sastra tutur, dan bahasa lisan nusantara untuk generasi mendatang"
                    </p>

                    <div class="pt-5 border-t border-obsidian-800 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs uppercase tracking-[0.2em] text-ink-400 font-light">
                        <span>Pilar Pengarsipan Nusantara</span>
                        <span>Nirlaba &bull; Bebas Akses &bull; Hak Adat Terlindungi</span>
                    </div>
                </div>
            </div>

            <!-- Archival Index Register (2x2 Grid) -->
            <div class="mb-2">
                <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-5 font-medium">
                    Pilar Kerja Pengarsipan
                </span>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                    <!-- Pillar 1 -->
                    <div class="p-6 sm:p-8 border border-obsidian-700/80 bg-obsidian-900/50 hover:bg-obsidian-900/90 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center space-x-3">
                                    <span class="w-8 h-8 rounded border border-obsidian-600 bg-obsidian-850 flex items-center justify-center font-serif text-xs font-bold text-ink-200">
                                        I
                                    </span>
                                    <span class="text-xs uppercase tracking-[0.2em] text-ink-400 font-medium">
                                        Metode & Akustik
                                    </span>
                                </div>
                                <svg class="w-4 h-4 text-ink-500/50 group-hover:text-ink-300 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 3v18M8 8v8M16 6v12M4 11v2M20 10v4" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-2.5">
                                Perekaman Otentik
                            </h3>
                            <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                                Merekam tuturan langsung dari penutur asli di komunitas asalnya. Kami merawat kejernihan akustik tuturan, dari nada suara, tarikan napas, sampai hening di antara bait
                            </p>
                        </div>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="p-6 sm:p-8 border border-obsidian-700/80 bg-obsidian-900/50 hover:bg-obsidian-900/90 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center space-x-3">
                                    <span class="w-8 h-8 rounded border border-obsidian-600 bg-obsidian-850 flex items-center justify-center font-serif text-xs font-bold text-ink-200">
                                        II
                                    </span>
                                    <span class="text-xs uppercase tracking-[0.2em] text-ink-400 font-medium">
                                        Etika & Hak Adat
                                    </span>
                                </div>
                                <svg class="w-4 h-4 text-ink-500/50 group-hover:text-ink-300 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-2.5">
                                Etika & Konsen Komunal
                            </h3>
                            <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                                Hanya merekam tuturan yang diizinkan oleh tetua dan pemangku adat. Hak moral cerita tetap milik komunitas asal. Tuturan sakral atau bertabu waktu tidak kami sebarluaskan
                            </p>
                        </div>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="p-6 sm:p-8 border border-obsidian-700/80 bg-obsidian-900/50 hover:bg-obsidian-900/90 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center space-x-3">
                                    <span class="w-8 h-8 rounded border border-obsidian-600 bg-obsidian-850 flex items-center justify-center font-serif text-xs font-bold text-ink-200">
                                        III
                                    </span>
                                    <span class="text-xs uppercase tracking-[0.2em] text-ink-400 font-medium">
                                        Akses & Riset
                                    </span>
                                </div>
                                <svg class="w-4 h-4 text-ink-500/50 group-hover:text-ink-300 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M3.6 9h16.8M3.6 15h16.8M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>
                                </svg>
                            </div>
                            <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-2.5">
                                Akses Terbuka Nirlaba
                            </h3>
                            <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                                Menyediakan repositori digital bebas biaya untuk pembelajaran, riset linguistik, dan pendengaran publik. Tanpa pungutan biaya dan bebas komersialisasi
                            </p>
                        </div>
                    </div>

                    <!-- Pillar 4 -->
                    <div class="p-6 sm:p-8 border border-obsidian-700/80 bg-obsidian-900/50 hover:bg-obsidian-900/90 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center space-x-3">
                                    <span class="w-8 h-8 rounded border border-obsidian-600 bg-obsidian-850 flex items-center justify-center font-serif text-xs font-bold text-ink-200">
                                        IV
                                    </span>
                                    <span class="text-xs uppercase tracking-[0.2em] text-ink-400 font-medium">
                                        Regenerasi & Edukasi
                                    </span>
                                </div>
                                <svg class="w-4 h-4 text-ink-500/50 group-hover:text-ink-300 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-2.5">
                                Penghubung Generasi
                            </h3>
                            <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                                Menjembatani tuturan masa lampau ke medium digital yang mudah dipahami kaum muda. Menjaga agar bahasa ibu dan kidung leluhur tetap berbunyi di telinga zaman
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. AJAKAN KOLABORASI & CTA -->
    <section class="py-14 sm:py-20 bg-linen-200 text-ink-900 border-b border-linen-300">
        <div class="max-w-3xl mx-auto px-4 sm:px-8 text-center">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block mb-3 font-semibold">
                Keterlibatan Bersama
            </span>
            
            <h2 class="font-serif text-2xl sm:text-4xl md:text-5xl font-bold uppercase tracking-tight leading-tight text-ink-900 mb-4">
                Punya Rekaman atau Mengetahui Penutur di Daerah Anda?
            </h2>
            
            <p class="text-ink-700 text-sm sm:text-base font-light leading-relaxed max-w-2xl mx-auto mb-8">
                Kerja merawat sastra tutur nusantara terlalu luas untuk dipikul sendiri. Kami menyambut pegiat budaya, peneliti bahasa, pemuda adat, atau siapa pun yang ingin mengabarkan rekaman tuturan berharga dari kampung halamannya
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('kontak') }}" class="w-full sm:w-auto px-9 py-4 bg-obsidian-950 text-ink-100 font-semibold hover:bg-obsidian-850 transition-colors duration-300 shadow-md">
                    Hubungi Tim Kurasi
                </a>
                <a href="{{ route('arsip.index') }}" class="w-full sm:w-auto px-9 py-4 border border-ink-900/40 text-ink-900 hover:border-ink-950 hover:bg-linen-100 transition-colors duration-300 font-medium">
                    Jelajahi Arsip Saat Ini
                </a>
            </div>
        </div>
    </section>
@endsection
