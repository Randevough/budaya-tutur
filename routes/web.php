<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Budaya Tutur
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

// Archive Listing (Filterable Directory with 60 req/min scraping defense)
Route::get('/arsip', [ArsipController::class, 'index'])
    ->middleware('throttle:60,1')
    ->name('arsip.index');

// Culture Item Detail (Lite YouTube Embed, Story & Transcription)
Route::get('/arsip/{slug}', [ArsipController::class, 'show'])->name('arsip.show');

// Contact Form (DB-First Fallback + SMTP with 5 submissions/min anti-spam limit)
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('kontak.store');

// Donation Page (Editorial Support & Archive Preservation)
Route::get('/donasi', [DonationController::class, 'index'])->name('donasi');

// ⚠️  TEMPORARY — DELETE IMMEDIATELY AFTER RUNNING MIGRATIONS ON HOSTINGER
Route::get('/artisan-migrate-bt9x2w', function () {
    abort_unless(request('key') === env('ARTISAN_WEB_KEY', 'bt9x2w-key'), 403, 'Akses tidak diizinkan.');
    Artisan::call('migrate', ['--force' => true]);
    return '<pre>' . htmlspecialchars(Artisan::output()) . '</pre>';
});
// ⚠️  END TEMPORARY

// ⚠️  TEMPORARY — DELETE IMMEDIATELY AFTER CLEARING CACHE ON HOSTINGER
Route::get('/artisan-cache-clear-bt9x2w', function () {
    abort_unless(request('key') === env('ARTISAN_WEB_KEY', 'bt9x2w-key'), 403, 'Akses tidak diizinkan.');
    Artisan::call('cache:clear');
    return '<pre>Cache cleared OK</pre>';
});
// ⚠️  END TEMPORARY

