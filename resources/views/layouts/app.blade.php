<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Budaya Tutur Voices — Arsip Suara & Cerita Lisan Nusantara')</title>
    <meta name="description" content="@yield('meta_description', 'Arsip digital budaya tutur, suara, dan cerita lisan nusantara. Menjaga yang terucap sebelum senyap.')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- OpenGraph / Social Metadata -->
    <meta property="og:site_name" content="Budaya Tutur Voices">
    <meta property="og:title" content="@yield('og_title', 'Budaya Tutur Voices — Arsip Suara & Cerita Lisan Nusantara')">
    <meta property="og:description" content="@yield('og_description', 'Arsip digital budaya tutur, suara, dan cerita lisan nusantara.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Budaya Tutur Voices — Arsip Suara & Cerita Lisan Nusantara')">
    <meta name="twitter:description" content="@yield('og_description', 'Arsip digital budaya tutur, suara, dan cerita lisan nusantara.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Structured Data (JSON-LD Organization) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Budaya Tutur Voices",
        "url": "{{ url('/') }}",
        "description": "Inisiatif pengarsipan digital mandiri untuk merekam, merawat, dan mempublikasikan suara dan sastra tutur lisan nusantara."
    }
    </script>
    @stack('schema')

    <!-- Primary Editorial Fonts: Mencken Std Head & Aktiv Grotesk Condensed (Local @font-face in app.css) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Leaflet Stylesheet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!-- Vite Compiled Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-obsidian-900 text-ink-100 font-sans antialiased min-h-screen flex flex-col selection:bg-ink-100 selection:text-obsidian-950">


    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-obsidian-900/95 border-b border-obsidian-700/80 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-20 flex items-center justify-between">
            <!-- Brand Mark -->
            <a href="{{ route('home') }}" class="group flex items-center space-x-3.5 focus:outline-none">
                <!-- Authentic Archival Emblem Placeholder -->
                <div class="w-10 h-10 rounded-full border border-obsidian-700 bg-obsidian-850/90 flex items-center justify-center text-ink-100 group-hover:border-ink-200 group-hover:bg-obsidian-800 transition-all duration-300 shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10" stroke-dasharray="2 3" stroke-opacity="0.5" />
                        <path d="M12 7v10" />
                        <path d="M8 9.5v5" />
                        <path d="M16 9.5v5" />
                        <path d="M4 11v2" />
                        <path d="M20 11v2" />
                    </svg>
                </div>
                <div class="flex flex-col justify-center">
                    <span class="font-serif text-lg sm:text-xl font-bold tracking-[0.18em] text-ink-100 uppercase group-hover:text-ink-200 transition-colors">
                        Budaya Tutur
                    </span>
                    <span class="text-xs tracking-[0.22em] uppercase text-ink-400 group-hover:text-ink-300 transition-colors">
                        Voices of Nusantara
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden md:flex items-center space-x-10 text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('home') }}" class="text-ink-300 hover:text-ink-100 transition-colors {{ request()->routeIs('home') ? 'text-ink-100 font-medium border-b border-ink-100 pb-1' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('about') }}" class="text-ink-300 hover:text-ink-100 transition-colors {{ request()->routeIs('about') ? 'text-ink-100 font-medium border-b border-ink-100 pb-1' : '' }}">
                    Tentang
                </a>
                <a href="{{ route('arsip.index') }}" class="text-ink-300 hover:text-ink-100 transition-colors {{ request()->routeIs('arsip.*') ? 'text-ink-100 font-medium border-b border-ink-100 pb-1' : '' }}">
                    Arsip Suara
                </a>
                @if(\App\Models\SiteSetting::current()->is_donation_active)
                    <a href="{{ route('donasi') }}" class="text-ink-300 hover:text-ink-100 transition-colors {{ request()->routeIs('donasi*') ? 'text-ink-100 font-medium border-b border-ink-100 pb-1' : '' }}">
                        Donasi
                    </a>
                @endif
            </nav>

            <!-- CTA: Contact -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('kontak') }}" class="px-5 py-2.5 border border-obsidian-600 hover:border-ink-100 text-xs tracking-[0.18em] uppercase text-ink-100 hover:bg-ink-100 hover:text-obsidian-950 transition-all duration-300 font-medium {{ request()->routeIs('kontak*') ? 'border-ink-100 bg-obsidian-800' : '' }}">
                    Kontak
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-toggle" type="button" class="md:hidden text-ink-300 hover:text-ink-100 p-2.5 focus:outline-none focus:ring-1 focus:ring-ink-100" aria-label="Buka Menu Navigasi" aria-expanded="false">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menu-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path id="menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Nav Menu Panel -->
        <div id="mobile-menu-panel" class="hidden md:hidden border-b border-obsidian-700 bg-obsidian-950 px-6 py-8 space-y-5">
            <a href="{{ route('home') }}" class="block text-sm uppercase tracking-[0.2em] text-ink-200 hover:text-ink-100">Beranda</a>
            <a href="{{ route('about') }}" class="block text-sm uppercase tracking-[0.2em] {{ request()->routeIs('about') ? 'text-ink-100 font-medium' : 'text-ink-200' }} hover:text-ink-100">Tentang</a>
            <a href="{{ route('arsip.index') }}" class="block text-sm uppercase tracking-[0.2em] text-ink-200 hover:text-ink-100">Arsip Suara</a>
            @if(\App\Models\SiteSetting::current()->is_donation_active)
                <a href="{{ route('donasi') }}" class="block text-sm uppercase tracking-[0.2em] {{ request()->routeIs('donasi*') ? 'text-ink-100 font-medium' : 'text-ink-200' }} hover:text-ink-100">Donasi</a>
            @endif
            <div class="pt-4 border-t border-obsidian-700">
                <a href="{{ route('kontak') }}" class="block text-center py-3 bg-ink-100 text-obsidian-950 text-xs uppercase tracking-[0.2em] font-semibold">
                    Hubungi Kami (Kontak)
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Editorial Footer (Grounded Nocturnal Velvet) -->
    <footer class="relative border-t border-obsidian-800/80 bg-obsidian-950 text-ink-400 py-16 sm:py-20 px-4 sm:px-8 overflow-hidden">
        <!-- Subtle Velvet ambient atmospheric lighting -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_90%_70%_at_50%_0%,_#1d1a17_0%,_#131110_40%,_#0a0908_100%)] pointer-events-none"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] sm:w-[900px] h-[220px] bg-[radial-gradient(ellipse_at_top,_rgba(244,240,234,0.06)_0%,_transparent_70%)] blur-[60px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto">
            <!-- Main 3-Column Asymmetric Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-16 text-sm mb-16">
                <!-- Col 1 (5 cols): Brand & Mission -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-9 h-9 rounded-full border border-obsidian-700 bg-obsidian-850 flex items-center justify-center text-ink-100 shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" stroke-dasharray="2 3" stroke-opacity="0.5" />
                                <path d="M12 7v10" />
                                <path d="M8 9.5v5" />
                                <path d="M16 9.5v5" />
                                <path d="M4 11v2" />
                                <path d="M20 11v2" />
                            </svg>
                        </div>
                        <span class="font-serif text-2xl font-bold tracking-[0.15em] text-ink-100 uppercase block">
                            Budaya Tutur
                        </span>
                    </div>
                    <p class="text-ink-400 text-xs sm:text-sm leading-relaxed max-w-md font-light">
                        Inisiatif pengarsipan digital mandiri untuk merekam, merawat, dan mempublikasikan suara, tuturan lisan, nyanyian ritual, dan kidung adat dari berbagai pelosok kepulauan nusantara.
                    </p>
                </div>

                <!-- Col 2 (3 cols): Navigasi -->
                <div class="md:col-span-3 space-y-4">
                    <h4 class="font-serif text-xs uppercase tracking-[0.25em] text-ink-100 font-semibold">
                        Navigasi
                    </h4>
                    <ul class="space-y-2.5 text-xs uppercase tracking-[0.18em] text-ink-400">
                        <li><a href="{{ route('home') }}" class="hover:text-ink-100 transition-colors inline-block hover:translate-x-0.5 duration-200">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-ink-100 transition-colors inline-block hover:translate-x-0.5 duration-200 {{ request()->routeIs('about') ? 'text-ink-100 font-medium' : '' }}">Tentang</a></li>
                        <li><a href="{{ route('arsip.index') }}" class="hover:text-ink-100 transition-colors inline-block hover:translate-x-0.5 duration-200">Arsip Suara</a></li>
                        @if(\App\Models\SiteSetting::current()->is_donation_active)
                            <li><a href="{{ route('donasi') }}" class="hover:text-ink-100 transition-colors inline-block hover:translate-x-0.5 duration-200 {{ request()->routeIs('donasi*') ? 'text-ink-100 font-medium' : '' }}">Donasi</a></li>
                        @endif
                        <li><a href="{{ route('kontak') }}" class="hover:text-ink-100 transition-colors inline-block hover:translate-x-0.5 duration-200 {{ request()->routeIs('kontak*') ? 'text-ink-100 font-medium' : '' }}">Kontak</a></li>
                    </ul>
                </div>

                <!-- Col 3 (4 cols): Terhubung / Media Sosial -->
                <div class="md:col-span-4 space-y-4">
                    <h4 class="font-serif text-xs uppercase tracking-[0.25em] text-ink-100 font-semibold">
                        Terhubung
                    </h4>
                    <ul class="space-y-3 text-xs tracking-wider text-ink-300">
                        <li>
                            <a href="https://youtube.com/@budayatutur" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center space-x-2 hover:text-ink-100 transition-colors">
                                <svg class="w-4 h-4 text-ink-400 group-hover:text-ink-100 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                                </svg>
                                <span>YouTube</span>
                                <svg class="w-3.5 h-3.5 text-ink-500 group-hover:text-ink-100 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="17" x2="17" y2="7"/>
                                    <polyline points="7 7 17 7 17 17"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:kontak@budayatutur.id" class="group inline-flex items-center space-x-2 hover:text-ink-100 transition-colors">
                                <svg class="w-4 h-4 text-ink-400 group-hover:text-ink-100 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <span>Email</span>
                                <svg class="w-3.5 h-3.5 text-ink-500 group-hover:text-ink-100 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="17" x2="17" y2="7"/>
                                    <polyline points="7 7 17 7 17 17"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center space-x-2 hover:text-ink-100 transition-colors">
                                <svg class="w-4 h-4 text-ink-400 group-hover:text-ink-100 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                </svg>
                                <span>WhatsApp</span>
                                <svg class="w-3.5 h-3.5 text-ink-500 group-hover:text-ink-100 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="17" x2="17" y2="7"/>
                                    <polyline points="7 7 17 7 17 17"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <div class="pt-2">
                        <a href="{{ url('/admin') }}" class="inline-block text-xs uppercase tracking-[0.18em] text-ink-400 hover:text-ink-200 transition-colors">
                            Portal Pengelola &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Strip -->
            <div class="pt-8 border-t border-obsidian-800/60 flex flex-col sm:flex-row items-center justify-between text-xs text-ink-400 tracking-wider uppercase font-light gap-4">
                <div>
                    &copy; <span id="copyright-year">{{ date('Y') }}</span> Budaya Tutur Voices. Dirawat untuk pengetahuan bersama.
                </div>
            </div>
        </div>
    </footer>

    <!-- Leaflet JS CDN -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('mobile-menu-toggle');
            const panel = document.getElementById('mobile-menu-panel');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            if (toggle && panel) {
                const closeMenu = () => {
                    panel.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    toggle.setAttribute('aria-expanded', 'false');
                };

                const openMenu = () => {
                    panel.classList.remove('hidden');
                    iconOpen.classList.add('hidden');
                    iconClose.classList.remove('hidden');
                    toggle.setAttribute('aria-expanded', 'true');
                };

                toggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = !panel.classList.contains('hidden');
                    if (isOpen) {
                        closeMenu();
                    } else {
                        openMenu();
                    }
                });

                // Dismiss on Escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !panel.classList.contains('hidden')) {
                        closeMenu();
                    }
                });

                // Dismiss on click outside
                document.addEventListener('click', (e) => {
                    if (!panel.classList.contains('hidden') && !panel.contains(e.target) && !toggle.contains(e.target)) {
                        closeMenu();
                    }
                });
            }

            // Dynamic Copyright Year Hydration
            const yearEl = document.getElementById('copyright-year');
            if (yearEl) {
                yearEl.textContent = new Date().getFullYear();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
