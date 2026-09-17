@extends('layouts.app')

@section('title', 'Narahubung & Kontribusi Rekaman — Budaya Tutur Voices')
@section('meta_description', 'Kirimkan pesan, usulan rekaman tutur, atau pertanyaan pengarsipan kepada tim kurasi Budaya Tutur Voices.')

@section('content')
    <!-- Header [DARK: Obsidian #121110] -->
    <header class="bg-obsidian-900 py-16 sm:py-24 border-b border-obsidian-700 text-ink-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center space-y-4">
            <span class="text-[11px] uppercase tracking-[0.3em] text-ink-400 block font-medium">
                Ruang Sambung
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold tracking-tight text-ink-100 uppercase">
                Hubungi Pengelola
            </h1>
            <p class="text-ink-300 text-xs sm:text-sm font-light leading-relaxed max-w-2xl mx-auto">
                Apakah Anda memiliki rekaman cerita lisan, syair kuno di kampung Anda, atau ingin berkolaborasi dalam dokumentasi tradisi tutur? Silakan sampaikan melalui formulir di bawah ini.
            </p>
        </div>
    </header>

    <!-- Form Section [LIGHT: Unbleached Linen #F8F5F0] -->
    <section class="bg-linen-100 text-ink-900 py-16 sm:py-24 border-b border-linen-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-8">
            <!-- Success Alert Banner -->
            @if(session('success'))
                <div class="mb-10 p-6 border border-ink-800 bg-linen-50 text-ink-900 text-xs sm:text-sm flex items-start space-x-4 shadow-sm">
                    <span class="text-ink-900 text-lg font-serif">&#10003;</span>
                    <div>
                        <p class="font-serif font-bold uppercase tracking-wider mb-1">Pesan Diterima</p>
                        <p class="text-ink-700 font-light">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Contact Form Card -->
            <div class="border border-linen-300 bg-linen-50 p-8 sm:p-12 shadow-sm">
                <form action="{{ route('kontak.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Silent Honeypot Field -->
                    <div class="hidden" aria-hidden="true">
                        <label for="website_url">Website URL (leave empty)</label>
                        <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-[11px] uppercase tracking-[0.2em] text-ink-700 font-medium">
                                Nama Lengkap <span class="text-ink-900">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   required 
                                   value="{{ old('name') }}"
                                   placeholder="Nama penutur / pengusul..."
                                   class="w-full bg-linen-100 border border-linen-300 focus:border-ink-900 text-ink-900 text-xs px-4 py-3.5 tracking-wide placeholder-ink-400 focus:outline-none transition-colors @error('name') border-red-500 @enderror">
                            @error('name')
                                <span class="text-[11px] text-red-600 tracking-wide">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="space-y-2">
                            <label for="email" class="block text-[11px] uppercase tracking-[0.2em] text-ink-700 font-medium">
                                Alamat Email <span class="text-ink-900">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   required 
                                   value="{{ old('email') }}"
                                   placeholder="alamat@surel.com"
                                   class="w-full bg-linen-100 border border-linen-300 focus:border-ink-900 text-ink-900 text-xs px-4 py-3.5 tracking-wide placeholder-ink-400 focus:outline-none transition-colors @error('email') border-red-500 @enderror">
                            @error('email')
                                <span class="text-[11px] text-red-600 tracking-wide">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="space-y-2">
                        <label for="subject" class="block text-[11px] uppercase tracking-[0.2em] text-ink-700 font-medium">
                            Subjek / Daerah Asal Rekaman
                        </label>
                        <input type="text" 
                               name="subject" 
                               id="subject" 
                               value="{{ old('subject') }}"
                               placeholder="Contoh: Usulan Dokumentasi Tradisi Tutur Desa..."
                               class="w-full bg-linen-100 border border-linen-300 focus:border-ink-900 text-ink-900 text-xs px-4 py-3.5 tracking-wide placeholder-ink-400 focus:outline-none transition-colors @error('subject') border-red-500 @enderror">
                        @error('subject')
                            <span class="text-[11px] text-red-600 tracking-wide">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Message Body -->
                    <div class="space-y-2">
                        <label for="message" class="block text-[11px] uppercase tracking-[0.2em] text-ink-700 font-medium">
                            Isi Pesan / Keterangan Rekaman <span class="text-ink-900">*</span>
                        </label>
                        <textarea name="message" 
                                  id="message" 
                                  rows="6" 
                                  required 
                                  placeholder="Ceritakan tentang materi tutur, riwayat penutur, atau maksud pesan Anda secara ringkas..."
                                  class="w-full bg-linen-100 border border-linen-300 focus:border-ink-900 text-ink-900 text-xs px-4 py-3.5 tracking-wide placeholder-ink-400 focus:outline-none transition-colors @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-[11px] text-red-600 tracking-wide">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-ink-900 text-linen-100 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-ink-800 transition-colors duration-300">
                            Kirimkan Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
