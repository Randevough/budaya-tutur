@extends('layouts.app')

@section('title', 'Tentang — Budaya Tutur Voices')

@section('content')
    <!-- 1. EDITORIAL HERO SECTION [DARK: Obsidian #121110 Velvet] -->
    <section class="relative bg-obsidian-900 border-b border-obsidian-700 py-20 sm:py-28 overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_35%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] sm:w-[950px] h-[340px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-8">
            <span class="text-[11px] uppercase tracking-[0.3em] text-ink-400 block mb-4 font-medium">
                Manifesto & Identitas
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-ink-100 leading-[1.15] uppercase mb-8">
                Menjaga Tutur,<br class="hidden sm:inline"> Merawat Ingatan Kolektif.
            </h1>
            <p class="text-ink-300 text-sm sm:text-base md:text-lg max-w-3xl font-light leading-relaxed">
                Budaya Tutur Voices adalah inisiatif pengarsipan digital mandiri yang didedikasikan untuk merekam, menyelamatkan, dan membuka akses terhadap sastra lisan, kidung ritual, mitos asal-usul, dan suara penutur asli dari berbagai pelosok kepulauan nusantara.
            </p>
        </div>
    </section>

    <!-- 2. PROFIL & LATAR BELAKANG [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-20 sm:py-28 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                <!-- Left Column: Sticky Section Marker -->
                <div class="lg:col-span-4 space-y-4">
                    <span class="text-[11px] uppercase tracking-[0.3em] text-ink-500 block font-medium">
                        01 / Latar Belakang
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold uppercase tracking-tight text-ink-950">
                        Ketika Suara Terancam Senyap
                    </h2>
                    <div class="w-12 h-px bg-ink-900/40 mt-4"></div>
                </div>

                <!-- Right Column: Narrative Body -->
                <div class="lg:col-span-8 space-y-6 text-sm sm:text-base text-ink-700 font-light leading-relaxed">
                    <p>
                        Sebagian besar pengetahuan leluhur di nusantara tidak diwariskan lewat lembaran kertas, melainkan melalui getaran suara: nyanyian panen para ibu di ladang, mantra penyembuhan tetua adat saat senja, kidung pelaut membaca navigasi bintang, hingga cerita pengantar tidur berima yang sarat filosofi hidup.
                    </p>
                    <p>
                        Namun, arus modernisasi yang tergesa-gesa serta berkurangnya penutur generasi tua membuat ribuan tradisi lisan ini berada di ambang kepunahan. Ketika seorang penutur adat berpulang tanpa dokumentasi yang memadai, satu perpustakaan pengetahuan lisan ikut terkubur bersama kepergiannya.
                    </p>
                    <p>
                        Kami hadir bukan sekadar untuk mencatat kata demi kata, melainkan menangkap nuansa asli tuturan: timbre suara, desah napas, intonasi emosional, dan hening di antara kalimat yang merupakan jiwa dari sastra tutur nusantara.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI [DARK: Obsidian #0C0B0A Charcoal] -->
    <section class="py-20 sm:py-28 bg-obsidian-950 text-ink-100 border-b border-obsidian-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Header -->
            <div class="max-w-3xl mb-16">
                <span class="text-[11px] uppercase tracking-[0.3em] text-ink-400 block mb-2 font-medium">
                    02 / Arah & Komitmen
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-100">
                    Visi & Misi Kami
                </h2>
            </div>

            <!-- Vision Panel -->
            <div class="mb-14 p-8 sm:p-12 border border-obsidian-800 bg-obsidian-900/60 backdrop-blur-sm">
                <span class="text-[10px] uppercase tracking-[0.3em] text-ink-400 block mb-3 font-medium">
                    Visi Utama
                </span>
                <p class="font-serif text-xl sm:text-2xl md:text-3xl text-ink-100 leading-snug font-normal">
                    "Menjadi rumah arsip digital terbuka paling tepercaya dan bermartabat bagi suara, sastra tutur, dan bahasa lisan nusantara untuk generasi mendatang."
                </p>
            </div>

            <!-- Mission Grid (4 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <!-- Mission 1 -->
                <div class="p-6 border border-obsidian-800/80 bg-obsidian-900/30 flex flex-col justify-between">
                    <div>
                        <span class="font-serif text-2xl text-ink-400 block mb-4">I.</span>
                        <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-3">
                            Perekaman Otentik
                        </h3>
                        <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                            Mendokumentasikan tuturan langsung dari penutur asli di komunitas asalnya dengan kualitas tata suara akustik beresolusi tinggi.
                        </p>
                    </div>
                </div>

                <!-- Mission 2 -->
                <div class="p-6 border border-obsidian-800/80 bg-obsidian-900/30 flex flex-col justify-between">
                    <div>
                        <span class="font-serif text-2xl text-ink-400 block mb-4">II.</span>
                        <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-3">
                            Etika & Integritas
                        </h3>
                        <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                            Menjunjung tinggi hak kepemilikan adat, konsen komunal, serta menjaga batas antara tuturan yang boleh dibuka publik dan tuturan sakral.
                        </p>
                    </div>
                </div>

                <!-- Mission 3 -->
                <div class="p-6 border border-obsidian-800/80 bg-obsidian-900/30 flex flex-col justify-between">
                    <div>
                        <span class="font-serif text-2xl text-ink-400 block mb-4">III.</span>
                        <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-3">
                            Akses Terbuka Nirlaba
                        </h3>
                        <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                            Menyediakan repositori digital bebas biaya untuk tujuan edukasi, penelitian linguistik, dan pemajuan kebudayaan nasional.
                        </p>
                    </div>
                </div>

                <!-- Mission 4 -->
                <div class="p-6 border border-obsidian-800/80 bg-obsidian-900/30 flex flex-col justify-between">
                    <div>
                        <span class="font-serif text-2xl text-ink-400 block mb-4">IV.</span>
                        <h3 class="font-serif text-lg font-bold text-ink-100 uppercase tracking-wide mb-3">
                            Penghubung Generasi
                        </h3>
                        <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                            Menjembatani rekaman masa lampau ke medium digital modern agar tetap relevan, mudah dipahami, dan menginspirasi kaum muda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. BRAND ASSET & FILOSOFI LOGO [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-20 sm:py-28 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="max-w-3xl mb-16">
                <span class="text-[11px] uppercase tracking-[0.3em] text-ink-500 block mb-2 font-medium">
                    03 / Identitas Visual
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-950">
                    Filosofi Lambang Budaya Tutur
                </h2>
                <p class="text-ink-600 text-xs sm:text-sm leading-relaxed font-light mt-3">
                    Lambang visual Budaya Tutur dirancang dengan prinsip kesederhanaan purba dan presisi akustik. Menggabungkan unsur lingkaran adat dan visualisasi frekuensi gelombang suara manusia.
                </p>
            </div>

            <!-- Emblem Showcase Container -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Visual Box (Large Emblem Presentation) -->
                <div class="lg:col-span-5 flex flex-col items-center justify-center p-12 sm:p-16 border border-linen-300 bg-linen-50 shadow-sm">
                    <div class="w-36 h-36 sm:w-44 sm:h-44 rounded-full border border-ink-900/20 bg-obsidian-950 flex items-center justify-center text-ink-100 shadow-md">
                        <svg class="w-20 h-20 sm:w-24 sm:h-24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-label="Lambang Budaya Tutur">
                            <circle cx="12" cy="12" r="10" stroke-dasharray="2 3" stroke-opacity="0.5" />
                            <path d="M12 7v10" />
                            <path d="M8 9.5v5" />
                            <path d="M16 9.5v5" />
                            <path d="M4 11v2" />
                            <path d="M20 11v2" />
                        </svg>
                    </div>
                    <span class="font-serif text-sm tracking-[0.25em] uppercase text-ink-800 font-semibold mt-6 block text-center">
                        The Resonant Circle
                    </span>
                    <span class="text-[10px] tracking-[0.2em] uppercase text-ink-500 mt-1 block text-center">
                        Arsip Akustik Nusantara
                    </span>
                </div>

                <!-- Meaning Pillars (3 Tenets) -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Tenet 1 -->
                    <div class="border-b border-linen-300 pb-6">
                        <div class="flex items-start space-x-4">
                            <span class="font-serif text-xl text-ink-400 font-bold">A.</span>
                            <div>
                                <h3 class="font-serif text-base sm:text-lg font-bold uppercase text-ink-950 tracking-wide mb-1.5">
                                    Lingkaran Komunal (Kans Tutur Melingkar)
                                </h3>
                                <p class="text-xs sm:text-sm text-ink-600 font-light leading-relaxed">
                                    Garis luar berbentuk lingkaran putus-putus melambangkan tradisi duduk melingkar di balai adat atau serambi bambu. Tidak ada hierarki dalam mendengarkan tuturan lisan; semua warga berkumpul dalam satu ruang kesadaran yang sama.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tenet 2 -->
                    <div class="border-b border-linen-300 pb-6">
                        <div class="flex items-start space-x-4">
                            <span class="font-serif text-xl text-ink-400 font-bold">B.</span>
                            <div>
                                <h3 class="font-serif text-base sm:text-lg font-bold uppercase text-ink-950 tracking-wide mb-1.5">
                                    Gelombang Resonansi Suara
                                </h3>
                                <p class="text-xs sm:text-sm text-ink-600 font-light leading-relaxed">
                                    Lima palang vertikal yang simetris merepresentasikan spektrum frekuensi tuturan manusia yang bergetar. Tiap tinggi garis menandai dinamika nada dari bisikan sakral hingga lantunan kidung yang melintasi bukit dan lautan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tenet 3 -->
                    <div>
                        <div class="flex items-start space-x-4">
                            <span class="font-serif text-xl text-ink-400 font-bold">C.</span>
                            <div>
                                <h3 class="font-serif text-base sm:text-lg font-bold uppercase text-ink-950 tracking-wide mb-1.5">
                                    Sumbu Tegak Tradisi
                                </h3>
                                <p class="text-xs sm:text-sm text-ink-600 font-light leading-relaxed">
                                    Garis poros di tengah yang tertinggi menandai jembatan tegak lurus antargenerasi: menghubungkan kebijaksanaan masa lampau para leluhur dengan masa kini dan masa depan keturunannya.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. ETIKA & PRINSIP PENGARSIPAN [DARK: Obsidian #121110 Velvet] -->
    <section class="py-20 sm:py-28 bg-obsidian-900 text-ink-100 border-b border-obsidian-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="max-w-3xl mb-16">
                <span class="text-[11px] uppercase tracking-[0.3em] text-ink-400 block mb-2 font-medium">
                    04 / Prinsip Dasar
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-100">
                    Etika & Protokol Pengarsipan
                </h2>
                <p class="text-ink-300 text-xs sm:text-sm leading-relaxed font-light mt-3">
                    Pengarsipan bukan proses perampasan pengetahuan adat. Setiap tahap kerja kami berpegang pada protokol budaya yang ketat dan etika kemanusiaan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 border border-obsidian-700 bg-obsidian-850">
                    <h3 class="font-serif text-lg font-bold uppercase text-ink-100 tracking-wide mb-3">
                        Persetujuan Komunal
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                        Kami hanya merekam dan mengunggah materi yang telah disetujui secara sadar oleh penutur dan pemangku adat setempat. Hak moral cerita tetap menjadi milik sah komunitas adat asal.
                    </p>
                </div>

                <div class="p-8 border border-obsidian-700 bg-obsidian-850">
                    <h3 class="font-serif text-lg font-bold uppercase text-ink-100 tracking-wide mb-3">
                        Perlindungan Kesakralan
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                        Sebagian tuturan nusantara memiliki pantangan musim, waktu, atau syarat inisiasi. Tuturan yang bersifat tertutup atau tabu tidak akan dipublikasikan secara umum.
                    </p>
                </div>

                <div class="p-8 border border-obsidian-700 bg-obsidian-850">
                    <h3 class="font-serif text-lg font-bold uppercase text-ink-100 tracking-wide mb-3">
                        Bebas Komersial
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-300 font-light leading-relaxed">
                        Seluruh rekaman dan arsip ini tidak diperjualbelikan untuk kepentingan komersial manapun. Pengarsipan ini sepenuhnya berstatus nirlaba demi ilmu pengetahuan publik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. AJAKAN KOLABORASI & CTA [LIGHT: Unbleached Linen Warm Peel] -->
    <section class="py-20 sm:py-28 bg-linen-200 text-ink-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center">
            <span class="text-[11px] uppercase tracking-[0.3em] text-ink-600 block mb-3 font-semibold">
                Keterlibatan Bersama
            </span>
            <h2 class="font-serif text-2xl sm:text-4xl md:text-5xl font-bold uppercase tracking-tight leading-tight mb-6">
                Punya Rekaman atau Mengetahui Penutur di Daerah Anda?
            </h2>
            <p class="text-ink-700 text-xs sm:text-sm md:text-base font-light leading-relaxed max-w-2xl mx-auto mb-10">
                Kerja merawat sastra tutur nusantara terlalu luas untuk dikerjakan sendiri. Kami mengundang pegiat budaya lokal, peneliti bahasa, komunitas pemuda adat, dan siapa saja untuk mengabarkan tuturan berharga dari kampung halaman Anda.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('kontak') }}" class="w-full sm:w-auto px-8 py-4 bg-obsidian-950 text-ink-100 font-semibold hover:bg-obsidian-850 transition-colors duration-300 shadow-md">
                    Hubungi Tim Kurasi
                </a>
                <a href="{{ route('arsip.index') }}" class="w-full sm:w-auto px-8 py-4 border border-ink-900/30 text-ink-900 hover:border-ink-950 hover:bg-linen-100 transition-colors duration-300">
                    Jelajahi Arsip Saat Ini
                </a>
            </div>
        </div>
    </section>
@endsection
