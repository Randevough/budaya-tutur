<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Budaya Tutur Voices
|--------------------------------------------------------------------------
|
| Clean, direct routes for public visitors.
| Monolithic Blade + Tailwind architecture.
|
*/

// Homepage (Dark Hero, Curated Voices, Interactive Centroid Map)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Archive Listing (Filterable Directory)
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');

// Culture Item Detail (Lite YouTube Embed, Story & Transcription)
Route::get('/galleries/{slug}', [GalleryController::class, 'show'])->name('galleries.show');

// Contact Form (DB-First Fallback + SMTP)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
