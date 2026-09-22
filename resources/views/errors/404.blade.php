@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan — Budaya Tutur Voices')
@section('meta_description', 'Halaman atau rekaman tutur lisan yang Anda cari tidak dapat ditemukan atau telah dipindahkan.')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center bg-obsidian-900 text-ink-100 py-20 px-4 sm:px-8 border-b border-obsidian-700">
    <div class="max-w-2xl text-center space-y-8">
        <span class="text-xs uppercase tracking-[0.3em] text-ink-400 font-medium block">
            Galat 404 &mdash; Jejak Tidak Ditemukan
        </span>

        <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-ink-100 uppercase leading-tight">
            Suara yang Dicari Telah Senyap
        </h1>

        <p class="text-ink-300 text-sm sm:text-base font-light leading-relaxed max-w-lg mx-auto">
            Halaman atau arsip tuturan yang Anda tuju belum terdaftar, telah dialihkan, atau tautan yang dimasukkan kurang tepat.
        </p>

        <div class="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('home') }}" 
               class="w-full sm:w-auto min-h-[48px] px-8 py-3.5 bg-ink-100 text-obsidian-950 text-xs uppercase tracking-[0.2em] font-semibold hover:bg-linen-200 transition-colors flex items-center justify-center focus:outline-none focus-visible:ring-2 focus-visible:ring-ink-100">
                Kembali ke Beranda
            </a>
            <a href="{{ route('arsip.index') }}" 
               class="w-full sm:w-auto min-h-[48px] px-8 py-3.5 border border-obsidian-600 hover:border-ink-100 text-xs uppercase tracking-[0.2em] text-ink-100 hover:bg-obsidian-850 transition-colors flex items-center justify-center focus:outline-none focus-visible:ring-2 focus-visible:ring-ink-100">
                Jelajahi Arsip
            </a>
        </div>
    </div>
</div>
@endsection
