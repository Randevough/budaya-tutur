<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * Injects Content-Security-Policy or Content-Security-Policy-Report-Only headers
     * with tailored directives to support:
     * - YouTube lite-embed and privacy-enhanced player (youtube-nocookie.com)
     * - YouTube thumbnails (img.youtube.com, i.ytimg.com)
     * - Leaflet.js library & assets (unpkg.com)
     * - Esri & OpenStreetMap tile layers (server.arcgisonline.com, tile.openstreetmap.org)
     * - Google Fonts (fonts.googleapis.com, fonts.gstatic.com)
     * - Google Analytics (googletagmanager.com, google-analytics.com)
     * - Vite development server (HMR in local environment)
     * - Filament admin panel (Alpine.js & Livewire reactive bindings)
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        if (! config('app.csp_enabled', env('CSP_ENABLED', true))) {
            return $response;
        }

        $headerName = config('app.csp_report_only', env('CSP_REPORT_ONLY', true))
            ? 'Content-Security-Policy-Report-Only'
            : 'Content-Security-Policy';

        $policy = $this->buildPolicy();

        $response->headers->set($headerName, $policy);

        return $response;
    }

    /**
     * Build the structured Content-Security-Policy string.
     */
    protected function buildPolicy(): string
    {
        $isLocal = app()->environment('local');

        $scriptSources = [
            "'self'",
            "'unsafe-inline'",
            "'unsafe-eval'", // Required for Filament/Alpine.js expressions
            'https://unpkg.com',
            'https://www.googletagmanager.com',
        ];

        $styleSources = [
            "'self'",
            "'unsafe-inline'",
            'https://fonts.googleapis.com',
            'https://unpkg.com',
        ];

        $connectSources = [
            "'self'",
            'https://server.arcgisonline.com',
            'https://*.tile.openstreetmap.org',
            'https://tile.openstreetmap.org',
            'https://*.google-analytics.com',
            'https://www.google-analytics.com',
            'https://analytics.google.com',
            'https://stats.g.doubleclick.net',
        ];

        // Enable Vite dev server origins during local development so HMR is never blocked
        if ($isLocal) {
            $scriptSources[] = 'http://127.0.0.1:5173';
            $scriptSources[] = 'http://localhost:5173';

            $styleSources[] = 'http://127.0.0.1:5173';
            $styleSources[] = 'http://localhost:5173';

            $connectSources[] = 'ws://127.0.0.1:5173';
            $connectSources[] = 'ws://localhost:5173';
            $connectSources[] = 'http://127.0.0.1:5173';
            $connectSources[] = 'http://localhost:5173';
        }

        $directives = [
            'default-src' => ["'self'"],
            'script-src' => array_unique($scriptSources),
            'style-src' => array_unique($styleSources),
            'img-src' => [
                "'self'",
                'data:',
                'blob:',
                'https://img.youtube.com',
                'https://i.ytimg.com',
                'https://server.arcgisonline.com',
                'https://*.tile.openstreetmap.org',
                'https://tile.openstreetmap.org',
                'https://unpkg.com',
                'https://www.google-analytics.com',
            ],
            'font-src' => [
                "'self'",
                'https://fonts.gstatic.com',
                'data:',
            ],
            'connect-src' => array_unique($connectSources),
            'frame-src' => [
                "'self'",
                'https://www.youtube-nocookie.com',
                'https://youtube-nocookie.com',
                'https://www.youtube.com',
            ],
            'media-src' => ["'self'"],
            'object-src' => ["'none'"],
            'base-uri' => ["'self'"],
            'form-action' => ["'self'"],
        ];

        return collect($directives)
            ->map(fn (array $sources, string $directive) => "{$directive} ".implode(' ', $sources))
            ->implode('; ');
    }
}
