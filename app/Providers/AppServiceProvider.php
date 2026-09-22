<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Safety guard: If public/hot exists on remote server (e.g. Hostinger), remove it
        // so Laravel does not attempt to load Vite dev server from local URL [::1]:5173
        if (!app()->runningInConsole()) {
            $hotFile = public_path('hot');
            if (file_exists($hotFile) && !in_array(request()->getHost(), ['localhost', '127.0.0.1'])) {
                @unlink($hotFile);
            }
        }

        // Auto-detect build directory when extracted into public_html with nested public/build
        if (!file_exists(public_path('build/manifest.json')) && file_exists(public_path('public/build/manifest.json'))) {
            Vite::useBuildDirectory('public/build');
        }
    }
}
