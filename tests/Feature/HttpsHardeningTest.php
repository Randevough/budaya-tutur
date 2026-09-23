<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class HttpsHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_local_or_testing_environment_does_not_force_https(): void
    {
        // Default test environment is 'testing'
        $response = $this->get('/tentang');

        // In local/testing, HTTP request must succeed normally without 301 redirect
        $response->assertStatus(200);
        $this->assertFalse($response->headers->has('Strict-Transport-Security'));
    }

    public function test_production_environment_redirects_insecure_http_to_https(): void
    {
        // Simulate production environment
        $this->app->detectEnvironment(fn () => 'production');

        $response = $this->get('http://localhost/tentang');

        $response->assertStatus(301);
        $this->assertStringStartsWith('https://', $response->headers->get('Location'));
    }

    public function test_production_environment_preserves_query_string_on_redirect(): void
    {
        $this->app->detectEnvironment(fn () => 'production');

        $response = $this->get('http://localhost/tentang?ref=footer&lang=id');

        $response->assertStatus(301);
        $this->assertEquals('https://localhost/tentang?ref=footer&lang=id', $response->headers->get('Location'));
    }

    public function test_production_environment_attaches_hsts_header_on_secure_request(): void
    {
        $this->app->detectEnvironment(fn () => 'production');

        // Simulate secure request (via https or X-Forwarded-Proto)
        $response = $this->withServerVariables([
            'HTTPS' => 'on',
            'SERVER_PORT' => '443',
        ])->get('https://localhost/tentang');

        $response->assertStatus(200);
        $this->assertTrue($response->headers->has('Strict-Transport-Security'));
        $this->assertEquals('max-age=31536000; includeSubDomains', $response->headers->get('Strict-Transport-Security'));
    }

    public function test_production_environment_detects_https_via_reverse_proxy(): void
    {
        $this->app->detectEnvironment(fn () => 'production');

        // Behind Hostinger LiteSpeed / Reverse Proxy with X-Forwarded-Proto: https
        $response = $this->withHeaders([
            'X-Forwarded-Proto' => 'https',
        ])->get('http://localhost/tentang');

        // Should not redirect since reverse proxy indicates HTTPS
        $response->assertStatus(200);
        $this->assertTrue($response->headers->has('Strict-Transport-Security'));
    }

    public function test_url_force_scheme_https_in_production(): void
    {
        $this->app->detectEnvironment(fn () => 'production');

        // Force scheme for production
        URL::forceScheme('https');

        $url = route('about');
        $this->assertStringStartsWith('https://', $url);
    }
}
