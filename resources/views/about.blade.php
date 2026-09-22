@extends('layouts.app')

@section('title', 'Tentang — Budaya Tutur')

@section('content')
    <!-- 1. EDITORIAL HERO SECTION [DARK: Obsidian #121110 Velvet] -->
    <section class="relative bg-obsidian-900 border-b border-obsidian-700 py-16 sm:py-24 overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_35%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] sm:w-[950px] h-[340px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-3 font-medium">
                Manifesto & Identitas
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-ink-100 leading-[1.15] uppercase mb-4 sm:mb-6">
                Menjaga Tutur,<br class="hidden sm:inline"> Merawat Ingatan Kolektif
            </h1>
            <p class="text-ink-300 text-sm sm:text-base md:text-lg max-w-3xl font-light leading-relaxed">
                Budaya Tutur adalah arsip digital independen untuk tuturan lisan nusantara. Kami merekam suara penutur asli di berbagai daerah dan menyimpannya secara terbuka agar cerita, kidung, dan sastra rakyat tidak hilang begitu saja.
            </p>
        </div>
    </section>

    <!-- 2. PROFIL & LATAR BELAKANG [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-16 sm:py-24 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
                <!-- Left Column: Section Marker -->
                <div class="lg:col-span-5 space-y-4">
                    <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block font-medium">
                        Latar Belakang
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold uppercase tracking-tight text-ink-900 leading-tight">
                        Ketika Suara Terancam Senyap
                    </h2>
                </div>

                <!-- Right Column: Narrative Body -->
                <div class="lg:col-span-7 space-y-6 text-sm sm:text-base text-ink-800 font-light leading-relaxed">
                    <p>
                        Banyak tradisi di nusantara hidup hanya dari ingatan ke ingatan. Kisah asal-usul, mantra adat, nyanyian kerja, sampai cerita pengantar tidur disampaikan lewat lisan tanpa pernah dicatat di atas kertas.
                    </p>
                    <p>
                        Masalahnya, saat penutur generasi tua berpulang dan generasi muda beralih bahasa, tuturan itu ikut hilang. Dalam hitungan tahun, tradisi tutur yang bertahan ratusan tahun bisa berhenti di satu orang terakhir.
                    </p>
                    <p>
                        Teks tertulis sering kali kehilangan intonasi, nada, dan dialek aslinya. Karena itu, kami memilih merekam suaranya secara utuh langsung dari penuturnya di lapangan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI [DARK: Obsidian #0C0B0A Charcoal - Compact Editorial Ledger] -->
    <section class="py-12 sm:py-16 md:py-20 bg-obsidian-950 text-ink-100 border-b border-obsidian-800 relative overflow-hidden">
        <!-- Subtle Ambient PEAT Glow -->
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[300px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.03)_0%,_transparent_70%)] blur-[60px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Header & Monumental Vision -->
            <div class="max-w-4xl mb-8 sm:mb-10">
                <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-2 font-medium">
                    Arah & Komitmen
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-100 mb-4">
                    Visi & Misi
                </h2>
                
                <p class="font-serif text-xl sm:text-2xl md:text-3xl text-ink-100 leading-snug sm:leading-relaxed font-normal">
                    “Menyediakan arsip suara yang terbuka, rapi, dan mudah diakses publik agar sastra tutur nusantara tetap punya tempat berpijak.”
                </p>
            </div>

            <!-- Archival Ledger (Compact Register) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 lg:gap-x-16 gap-y-6 sm:gap-y-8">
                <!-- Pillar 1 -->
                <div class="border-t border-obsidian-700/80 pt-4">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-ink-100 uppercase tracking-wide mb-2">
                        Perekaman Otentik
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                        Merekam langsung dari penutur di tempat tinggalnya dengan kualitas audio yang jernih, tanpa mengubah dialek atau memotong konteks cerita.
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="border-t border-obsidian-700/80 pt-4">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-ink-100 uppercase tracking-wide mb-2">
                        Etika & Hak Adat
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                        Perekaman dilakukan atas izin penutur dan pemangku adat. Hak kepemilikan cerita tetap ada pada komunitas asal, dan tuturan sakral tidak kami publikasikan.
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="border-t border-obsidian-700/80 pt-4">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-ink-100 uppercase tracking-wide mb-2">
                        Akses Terbuka Nirlaba
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                        Seluruh arsip dapat didengarkan secara gratis untuk kebutuhan riset, belajar di kelas, atau dokumentasi keluarga. Bebas biaya dan non-komersial.
                    </p>
                </div>

                <!-- Pillar 4 -->
                <div class="border-t border-obsidian-700/80 pt-4">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-ink-100 uppercase tracking-wide mb-2">
                        Penghubung Generasi
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                        Menyajikan rekaman audio dalam format digital yang ringkas agar generasi muda bisa mendengar langsung suara dan bahasa leluhurnya lewat internet.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. AJAKAN KOLABORASI & CTA -->
    <section class="py-14 sm:py-20 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-3xl mx-auto px-4 sm:px-8 text-center">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block mb-3 font-semibold">
                Keterlibatan Bersama
            </span>
            
            <h2 class="font-serif text-2xl sm:text-4xl md:text-5xl font-bold uppercase tracking-tight leading-tight text-ink-900 mb-4">
                Punya Rekaman atau Mengetahui Penutur di Daerah Anda?
            </h2>
            
            <p class="text-ink-700 text-sm sm:text-base font-light leading-relaxed max-w-2xl mx-auto mb-8">
                Kami tidak bisa mendatangi semua pelosok sendirian. Kalau Anda memiliki rekaman audio sastra lisan atau mengenal penutur adat yang bersedia direkam, kabari kami.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('kontak') }}" class="w-full sm:w-auto min-h-[48px] px-9 py-4 bg-obsidian-950 text-ink-100 font-semibold hover:bg-obsidian-850 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.99] transition-all duration-300 ease-out flex items-center justify-center shadow-md">
                    Hubungi Tim Kurasi
                </a>
                <a href="{{ route('arsip.index') }}" class="w-full sm:w-auto min-h-[48px] px-9 py-4 border border-obsidian-900/30 text-ink-900 hover:border-obsidian-950 hover:bg-linen-50 hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.99] transition-all duration-300 ease-out font-medium flex items-center justify-center">
                    Jelajahi Arsip Saat Ini
                </a>
            </div>
        </div>
    </section>
@endsection
