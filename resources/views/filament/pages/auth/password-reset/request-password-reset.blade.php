<x-filament-panels::page.simple>
    @vite(['resources/css/app.css'])

    <div class="budaya-auth-container w-full relative">
        <!-- Top-Left Back Navigation with Custom Animated Arrow Icon -->
        <div class="mb-6 -mt-2 text-left">
            <a href="{{ filament()->getLoginUrl() }}"
                class="inline-flex items-center text-xs tracking-[0.14em] uppercase text-[#7a736a] hover:text-[#181615] font-semibold transition-colors duration-200 group focus:outline-none"
                title="Kembali ke halaman masuk">
                <svg class="w-3.5 h-3.5 mr-2 transition-transform duration-200 ease-out group-hover:-translate-x-1.5 shrink-0 text-[#7a736a] group-hover:text-[#181615]"
                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Kembali ke halaman masuk</span>
            </a>
        </div>

        <!-- Archival Brand Header -->
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center mb-3 group focus:outline-none"
                title="Kembali ke Beranda">
                <div style="width: 3.25rem; height: 3.25rem; border-radius: 9999px; background-color: #121110; border: 1px solid #2c2825; display: flex; align-items: center; justify-content: center; color: #f4f0ea; box-shadow: 0 2px 6px rgba(0,0,0,0.15);"
                    class="group-hover:border-[#5c554e] group-hover:bg-[#1c1a18] transition-all duration-300">
                    <svg style="width: 1.4rem; height: 1.4rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10" stroke-dasharray="2 3" stroke-opacity="0.5" />
                        <path d="M12 7v10" />
                        <path d="M8 9.5v5" />
                        <path d="M16 9.5v5" />
                        <path d="M4 11v2" />
                        <path d="M20 11v2" />
                    </svg>
                </div>
            </a>

            <!-- Single Row Title -->
            <h1 class="font-serif text-lg sm:text-xl font-bold tracking-[0.08em] sm:tracking-[0.10em] uppercase text-[#181615] whitespace-nowrap leading-tight"
                style="font-family: 'Cinzel', Georgia, serif;">
                Lupa Kata Sandi?
            </h1>
            <p class="text-xs text-[#7a736a] mt-2 max-w-xs mx-auto leading-relaxed">
                Masukkan alamat email yang terdaftar untuk menerima link pemulihan kata sandi
            </p>
        </div>

        <!-- Filament Livewire Form Schema -->
        <div class="budaya-auth-form">
            {{ $this->content }}
        </div>
    </div>

    <!-- Sent Confirmation Modal System -->
    @if ($emailSent)
        <div x-data="{ show: true }" x-show="show" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#121110]/70 backdrop-blur-sm" role="dialog"
            aria-modal="true" aria-labelledby="sent-modal-title">
            <div x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-3"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                class="bg-[#fdfbf7] border border-[#e3ddd3] rounded-xl shadow-2xl max-w-md w-full p-6 sm:p-8 text-center relative overflow-hidden"
                style="box-shadow: 0 20px 40px -8px rgba(18, 17, 16, 0.25);">
                <!-- Archival Icon: Sent Envelope & Seal -->
                <div
                    class="mx-auto w-14 h-14 rounded-full bg-[#121110] border border-[#2c2825] flex items-center justify-center text-[#f4f0ea] shadow-md mb-4">
                    <svg class="w-6 h-6 text-[#f4f0ea]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h9" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        <path d="m16 19 2 2 4-4" />
                    </svg>
                </div>

                <h2 id="sent-modal-title"
                    class="font-serif text-xl sm:text-2xl font-bold tracking-[0.10em] uppercase text-[#181615] leading-snug whitespace-nowrap"
                    style="font-family: 'Cinzel', Georgia, serif;">
                    Instruksi Telah Dikirim
                </h2>

                <p class="text-xs sm:text-sm text-[#5c554e] leading-relaxed mt-2">
                    Jika email terdaftar di sistem, tautan pengaturan ulang kata sandi telah dikirimkan ke:
                </p>

                @if ($sentEmail)
                    <div
                        class="my-3 py-2 px-3 bg-[#f2ece2] border border-[#dcd4c7] rounded-md text-xs sm:text-sm font-semibold text-[#181615] font-mono break-all inline-block max-w-full">
                        {{ $sentEmail }}
                    </div>
                @endif

                <div
                    class="bg-[#f8f5f0] border border-[#e8e2d8] rounded-md p-3 text-left my-4 text-[11px] sm:text-xs text-[#6e675e] space-y-1">
                    <div class="flex items-start gap-2">
                        <span class="text-[#181615] font-bold">&bull;</span>
                        <span>Periksa kotak masuk (inbox) atau folder <strong>Spam / Junk</strong> Anda.</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-[#181615] font-bold">&bull;</span>
                        <span>Demi keamanan, tautan ini hanya berlaku selama <strong>60 menit</strong>.</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex flex-col gap-3">
                    <a href="{{ filament()->getLoginUrl() }}"
                        class="w-full inline-flex items-center justify-center py-3 px-4 bg-[#0c0b0a] hover:bg-[#2c2825] text-[#fdfbf7] text-xs font-semibold uppercase tracking-[0.18em] rounded-md transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                        Kembali ke Halaman Masuk
                    </a>

                    <button type="button" wire:click="resetConfirmation"
                        class="text-xs text-[#7a736a] hover:text-[#181615] font-medium uppercase tracking-[0.14em] transition-colors py-1.5 focus:outline-none inline-flex items-center justify-center gap-1.5 group">
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 ease-out group-hover:-translate-x-1 shrink-0 text-[#7a736a] group-hover:text-[#181615]"
                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        <span>Kirim Ulang atau Ganti Email</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page.simple>