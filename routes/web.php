<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Budaya Tutur Voices
|--------------------------------------------------------------------------
|
| Clean, direct routes for public visitors.
| Monolithic Blade + Tailwind architecture with consistent Indonesian URIs.
|
*/

// Homepage (Dark Hero, Curated Voices, Interactive Centroid Map)
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Page (Mission, Vision, Emblem Philosophy & Ethics)
Route::view('/tentang', 'about')->name('about');

// Archive Listing (Filterable Directory)
Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');

// Culture Item Detail (Lite YouTube Embed, Story & Transcription)
Route::get('/arsip/{slug}', [ArsipController::class, 'show'])->name('arsip.show');

// Contact Form (DB-First Fallback + SMTP)
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

