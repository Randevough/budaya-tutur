@extends('layouts.app')

@section('title', 'Dukungan & Donasi Pengarsipan | Budaya Tutur')
@section('meta_description', 'Dukung inisiatif pengarsipan mandiri suara dan sastra lisan nusantara.')

@section('content')
    <!-- 1. HERO SECTION [DARK: Obsidian #121110 Velvet - Compact] -->
    <section class="relative bg-obsidian-900 border-b border-obsidian-700 py-10 sm:py-14 overflow-hidden">
        <!-- Subtle Gallery Ambient Spotlight -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_65%_at_50%_35%,_#221e1a_0%,_#171513_38%,_#121110_72%,_#080807_100%)] pointer-events-none"></div>
        <div class="absolute top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] sm:w-[950px] h-[340px] bg-[radial-gradient(ellipse_at_center,_rgba(244,240,234,0.06)_0%,_rgba(180,165,150,0.03)_45%,_transparent_70%)] blur-[70px] pointer-events-none"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-8">
            <span class="text-xs uppercase tracking-[0.25em] text-ink-400 block mb-2 font-medium">
                Dukungan & Donasi
            </span>
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-ink-100 leading-[1.15] uppercase mb-3">
                Dukung Pengarsipan<br class="hidden sm:inline"> Budaya Tutur
            </h1>
            <p class="text-ink-300 text-sm sm:text-base max-w-2xl font-light leading-relaxed">
                Proyek ini berjalan mandiri tanpa sponsor komersial. Donasi dipakai langsung untuk ongkos perjalanan tim ke lapangan, sewa alat rekam, dan sewa server agar arsip tetap bisa diakses gratis.
            </p>
        </div>
    </section>

    <!-- 2. KANAL RESMI: MINIMALIST FOCUSED LEDGER [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="py-10 sm:py-14 bg-linen-100 text-ink-900 border-b border-linen-300">
        <div class="max-w-5xl mx-auto px-4 sm:px-8">
            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <span class="text-xs uppercase tracking-[0.25em] text-ink-500 block mb-1 font-medium">
                    Kanal Resmi
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold uppercase tracking-tight text-ink-950 mb-1.5">
                    Rekening Bank & QRIS
                </h2>
                <p class="text-ink-600 text-xs sm:text-sm font-light">
                    Donasi masuk langsung ke rekening yayasan atau QRIS tanpa potongan perantara platform.
                </p>
            </div>

            <!-- Focused Two-Column Layout (Single Pair of Hairline Borders) -->
            <div class="border-y border-linen-300 py-8 grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Sisi Kiri: Transfer Bank (Fokus Utama Nomor Rekening) -->
                <div class="md:col-span-7 space-y-2.5">
                    <span class="text-xs uppercase tracking-[0.2em] text-ink-500 font-semibold block">
                        {{ $settings->bank_name ?? 'Bank Central Asia (BCA)' }}
                    </span>

                    <div class="flex flex-wrap items-center gap-3">
                        <span id="account-number" class="font-mono text-3xl sm:text-4xl font-bold tracking-wider text-ink-950 break-all select-all">
                            {{ $settings->bank_account_number ?? '123-456-7890' }}
                        </span>
                        <button
                            type="button"
                            id="copy-account-btn"
                            onclick="copyAccountNumber()"
                            class="min-h-[36px] px-3.5 py-1.5 border border-ink-900 text-ink-950 hover:bg-ink-950 hover:text-linen-100 active:translate-y-0.5 text-xs font-semibold uppercase tracking-[0.18em] transition-all inline-flex items-center space-x-1.5 cursor-pointer shadow-sm shrink-0"
                            aria-label="Salin nomor rekening ke papan klip"
                        >
                            <svg id="copy-icon" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2" stroke-width="1.5"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" stroke-width="1.5"></path>
                            </svg>
                            <span id="copy-label">Salin</span>
                        </button>
                    </div>

                    <p class="text-xs sm:text-sm text-ink-600 font-medium">
                        a.n. {{ $settings->bank_account_name ?? 'Yayasan Budaya Tutur Nusantara' }}
                    </p>

                    <p class="text-xs text-ink-500 font-light pt-1">
                        Berapa pun nominalnya, bantuan Anda membantu arsip ini terus bertambah dan terawat.
                    </p>
                </div>

                <!-- Sisi Kanan: QRIS (Bersih & Ramping) -->
                <div class="md:col-span-5 flex flex-col items-center md:items-end justify-center space-y-2.5">
                    <div class="p-3 bg-white border border-linen-300 shadow-sm shrink-0">
                        @if(!empty($settings->qris_image))
                            <img
                                src="{{ asset('storage/' . $settings->qris_image) }}"
                                alt="Barcode QRIS Budaya Tutur"
                                class="w-44 h-44 object-contain"
                                loading="lazy"
                                decoding="async"
                                width="176"
                                height="176"
                            />
                        @else
                            <div class="w-44 h-44 bg-linen-50 border border-dashed border-linen-300 flex flex-col items-center justify-center p-3 text-obsidian-950 text-center">
                                <svg class="w-12 h-12 text-ink-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7" stroke-width="1.5"></rect>
                                    <rect x="14" y="3" width="7" height="7" stroke-width="1.5"></rect>
                                    <rect x="3" y="14" width="7" height="7" stroke-width="1.5"></rect>
                                    <rect x="14" y="14" width="7" height="7" stroke-width="1.5"></rect>
                                </svg>
                                <span class="font-serif text-xs uppercase tracking-wider font-bold text-ink-900">QRIS Tersedia</span>
                            </div>
                        @endif
                    </div>

                    @if(!empty($settings->qris_image))
                        <div>
                            <a
                                href="{{ asset('storage/' . $settings->qris_image) }}"
                                download="QRIS-Budaya-Tutur.png"
                                class="inline-flex items-center space-x-1.5 text-xs tracking-[0.18em] uppercase text-ink-900 border-b border-ink-900 hover:text-ink-600 hover:border-ink-600 transition-colors pb-0.5 font-medium cursor-pointer"
                            >
                                <span>Unduh Gambar QRIS</span>
                                <svg class="w-3.5 h-3.5 text-ink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- 3. KONFIRMASI SUKARELA (1 BARIS RINGKAS) -->
            <div class="pt-6">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-6">
                    <p class="text-xs text-ink-600 font-light text-center sm:text-left">
                        Kirim bukti transfer tidak wajib. Butuh konfirmasi atau ada pertanyaan terkait dana pengarsipan?
                    </p>

                    @php
                        $waNumber = \App\Models\SiteSetting::normalizeWhatsApp($settings->contact_whatsapp ?? '6281234567890');
                        $waMessage = rawurlencode("Halo Budaya Tutur, saya ingin mengonfirmasi donasi pengarsipan.");
                    @endphp

                    <div class="shrink-0">
                        <a
                            href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="min-h-[40px] inline-flex items-center justify-center space-x-2 px-5 py-2 bg-obsidian-950 hover:bg-obsidian-850 text-linen-100 font-semibold text-xs uppercase tracking-[0.18em] hover:-translate-y-0.5 hover:shadow-md active:translate-y-0 transition-all duration-200"
                        >
                            <svg class="w-4 h-4 text-linen-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                    </div>
                </div>

                <div class="pt-4 text-center text-xs text-ink-400 font-light leading-relaxed max-w-lg mx-auto">
                    Budaya Tutur dikelola nirlaba. Hak atas cerita dan rekaman suara tetap milik penutur serta komunitas adat asalnya.
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
                if (copyLabel) copyLabel.innerText = 'Salin';
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
