@extends('layouts.app')

@section('title', 'Dukungan & Donasi Pengarsipan | Budaya Tutur Voices')
@section('meta_description', 'Dukung inisiatif pengarsipan mandiri suara dan sastra lisan nusantara.')

@section('content')
    <!-- 1. HERO SECTION [DARK: Obsidian #121110 Velvet] -->
    <section class="relative bg-obsidian-900 border-b border-obsidian-700 py-16 sm:py-24 overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_35%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] sm:w-[950px] h-[340px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-8">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-3 font-medium">
                Dukungan & Donasi
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-ink-100 leading-[1.15] uppercase mb-6">
                Dukung Pengarsipan<br class="hidden sm:inline"> Budaya Tutur
            </h1>
            <p class="text-ink-300 text-sm sm:text-base md:text-lg max-w-2xl font-light leading-relaxed">
                Budaya Tutur adalah proyek pengarsipan mandiri dan nirlaba. Donasi Anda membantu biaya rekaman lapangan dan pemeliharaan server agar arsip ini tetap bebas diakses
            </p>
        </div>
    </section>

    <!-- 2. KANAL RESMI & KONFIRMASI [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-16 sm:py-24 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <!-- Header -->
            <div class="max-w-3xl mb-10 sm:mb-14">
                <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block mb-2 font-medium">
                    Kanal Resmi
                </span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold uppercase tracking-tight text-ink-950 mb-3">
                    Rekening Bank & QRIS
                </h2>
                <p class="text-ink-600 text-xs sm:text-sm font-light leading-relaxed">
                    Salurkan dukungan secara langsung tanpa perantara potongan platform. Kami menerima transfer bank domestik maupun pemindaian QRIS dari aplikasi perbankan atau dompet digital apa saja
                </p>
            </div>

            <!-- Two Column Transaction Hub -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch mb-16 sm:mb-20">
                <!-- Method 1: Bank Transfer (7 cols) -->
                <div class="lg:col-span-7 p-6 sm:p-10 border border-linen-300 bg-linen-50 flex flex-col justify-between relative shadow-sm">
                    <div>
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 rounded-full border border-linen-300 bg-linen-200 flex items-center justify-center text-ink-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <span class="text-xs uppercase tracking-[0.25em] text-ink-700 font-medium">
                                Transfer Bank Domestik
                            </span>
                        </div>

                        <div class="space-y-6 pt-1">
                            <div>
                                <span class="text-xs uppercase tracking-[0.2em] text-ink-600 block mb-1">Nama Bank</span>
                                <p class="font-serif text-xl sm:text-2xl font-bold text-ink-950 tracking-wide">
                                    {{ $settings->bank_name ?? 'Bank Central Asia (BCA)' }}
                                </p>
                            </div>

                            <div class="p-4 sm:p-5 bg-linen-200/60 border border-linen-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="min-w-0">
                                    <span class="text-xs uppercase tracking-[0.2em] text-ink-600 block mb-1">Nomor Rekening</span>
                                    <span id="account-number" class="font-mono text-lg sm:text-xl md:text-2xl font-semibold tracking-wider text-ink-950 break-all block">
                                        {{ $settings->bank_account_number ?? '123-456-7890' }}
                                    </span>
                                </div>
                                <button
                                    type="button"
                                    id="copy-account-btn"
                                    onclick="copyAccountNumber()"
                                    class="w-full sm:w-auto min-h-[44px] inline-flex items-center justify-center space-x-2 px-5 py-2.5 bg-obsidian-900 hover:bg-obsidian-800 text-ink-100 text-xs font-semibold uppercase tracking-[0.18em] transition-colors focus:outline-none focus:ring-2 focus:ring-obsidian-700 cursor-pointer shadow-sm shrink-0"
                                    aria-label="Salin nomor rekening ke papan klip"
                                >
                                    <svg id="copy-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2" stroke-width="1.5"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" stroke-width="1.5"></path>
                                    </svg>
                                    <span id="copy-label">Salin Nomor</span>
                                </button>
                            </div>

                            <div>
                                <span class="text-xs uppercase tracking-[0.2em] text-ink-600 block mb-1">Atas Nama Rekening</span>
                                <p class="text-sm sm:text-base font-medium text-ink-800">
                                    {{ $settings->bank_account_name ?? 'Yayasan Budaya Tutur Nusantara' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-linen-300 text-xs text-ink-600 font-light leading-relaxed">
                        Terima kasih atas kepedulian Anda terhadap kelestarian sastra tutur nusantara
                    </div>
                </div>

                <!-- Method 2: QRIS (5 cols) -->
                <div class="lg:col-span-5 p-6 sm:p-10 border border-linen-300 bg-linen-50 flex flex-col justify-between items-center text-center shadow-sm">
                    <div class="w-full">
                        <div class="flex items-center justify-center space-x-3 mb-6">
                            <div class="w-8 h-8 rounded-full border border-linen-300 bg-linen-200 flex items-center justify-center text-ink-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7" stroke-width="1.5"></rect>
                                    <rect x="14" y="3" width="7" height="7" stroke-width="1.5"></rect>
                                    <rect x="3" y="14" width="7" height="7" stroke-width="1.5"></rect>
                                    <rect x="14" y="14" width="7" height="7" stroke-width="1.5"></rect>
                                </svg>
                            </div>
                            <span class="text-xs uppercase tracking-[0.25em] text-ink-700 font-medium">
                                Kode QRIS Nasional
                            </span>
                        </div>

                        <!-- QR Box Container with Clean Frame -->
                        <div class="inline-block p-4 sm:p-5 bg-white border border-linen-300 rounded-sm mb-4 shadow-sm">
                            @if(!empty($settings->qris_image))
                                <img
                                    src="{{ asset('storage/' . $settings->qris_image) }}"
                                    alt="Barcode QRIS Budaya Tutur Voices"
                                    class="w-48 h-48 sm:w-52 sm:h-52 object-contain"
                                />
                            @else
                                <!-- Clean Archival QR Frame Placeholder -->
                                <div class="w-48 h-48 sm:w-52 sm:h-52 bg-linen-100 border border-linen-300 flex flex-col items-center justify-center p-4 text-obsidian-950">
                                    <svg class="w-16 h-16 text-obsidian-800 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                    <span class="font-serif text-xs uppercase tracking-widest font-bold text-obsidian-900">QRIS Tersedia</span>
                                    <span class="text-xs uppercase tracking-wider text-ink-600 mt-0.5">Semua Bank & Dompet Digital</span>
                                </div>
                            @endif
                        </div>

                        <p class="text-xs text-ink-600 font-light max-w-xs mx-auto mb-6">
                            Pindai melalui BCA Mobile, Livin by Mandiri, BRImo, GoPay, OVO, atau aplikasi pembayaran lainnya
                        </p>
                    </div>

                    @if(!empty($settings->qris_image))
                        <a
                            href="{{ asset('storage/' . $settings->qris_image) }}"
                            download="QRIS-Budaya-Tutur.png"
                            class="w-full sm:w-auto px-6 py-2.5 border border-linen-400 hover:border-obsidian-900 text-xs tracking-[0.18em] uppercase text-ink-900 hover:bg-linen-200 transition-all font-medium inline-flex items-center justify-center space-x-2"
                        >
                            <svg class="w-3.5 h-3.5 text-ink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span>Unduh Kode QRIS</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Integrated Konfirmasi Sukarela Block (Seamless Linen #F8F5F0) -->
            <div class="pt-12 sm:pt-16 border-t border-linen-300">
                <div class="max-w-2xl mx-auto text-center space-y-6">
                    <div class="space-y-2.5">
                        <span class="text-xs uppercase tracking-[0.25em] text-ink-600 block font-medium">
                            Hubungi Pengelola
                        </span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold uppercase tracking-tight text-ink-950">
                            Konfirmasi Sukarela
                        </h3>
                        <p class="text-ink-600 text-xs sm:text-sm font-light leading-relaxed">
                            Konfirmasi donasi bersifat sukarela. Jika Anda ingin mengirimkan bukti transfer atau menyapa tim pengelola, silakan hubungi kami melalui WhatsApp
                        </p>
                    </div>

                    @php
                        $waNumber = \App\Models\SiteSetting::normalizeWhatsApp($settings->contact_whatsapp ?? '6281234567890');
                        $waMessage = rawurlencode("Halo Budaya Tutur Voices, saya ingin mengonfirmasi donasi pengarsipan.");
                    @endphp

                    <div>
                        <a
                            href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center space-x-3 px-8 py-3.5 bg-obsidian-900 hover:bg-obsidian-800 text-ink-100 font-semibold text-xs uppercase tracking-[0.2em] transition-all duration-200 shadow-sm"
                        >
                            <svg class="w-4 h-4 text-ink-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                            <span>Konfirmasi via WhatsApp</span>
                        </a>
                    </div>

                    <div class="pt-6 border-t border-linen-300 text-xs text-ink-600 font-light leading-relaxed max-w-lg mx-auto">
                        Budaya Tutur beroperasi secara nirlaba. Seluruh rekaman suara tetap menjadi milik moral para penutur dan komunitas asalnya
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function copyAccountNumber() {
        const accountEl = document.getElementById('account-number');
        if (!accountEl) return;

        const text = accountEl.innerText.trim();
        const copyLabel = document.getElementById('copy-label');
        const copyIcon = document.getElementById('copy-icon');

        navigator.clipboard.writeText(text).then(() => {
            if (copyLabel) copyLabel.innerText = 'Tersalin!';
            if (copyIcon) {
                copyIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
            }

            setTimeout(() => {
                if (copyLabel) copyLabel.innerText = 'Salin Nomor';
                if (copyIcon) {
                    copyIcon.innerHTML = '<rect x="9" y="9" width="13" height="13" rx="2" ry="2" stroke-width="1.5"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" stroke-width="1.5"></path>';
                }
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin:', err);
        });
    }
</script>
@endpush
