<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceHttps
{
    /**
     * Handle an incoming request.
     *
     * In production:
     * 1. Automatically 301-redirect any insecure HTTP requests to HTTPS.
     * 2. Append Strict-Transport-Security (HSTS) header to enforce browser-level HTTPS.
     *
     * In local / testing environments:
     * Bypass completely to prevent disruption to local development and test runners.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('production')) {
            if (! $request->isSecure()) {
                return redirect()->secure($request->getRequestUri(), 301);
            }

            /** @var Response $response */
            $response = $next($request);

            // 1 year max-age with all subdomains included
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

            return $response;
        }

        return $next($request);
    }
}
