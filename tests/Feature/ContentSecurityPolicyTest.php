<?php

namespace Tests\Feature;

use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ContentSecurityPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_csp_header_is_present_in_report_only_mode_by_default(): void
    {
        Config::set('app.csp_enabled', true);
        Config::set('app.csp_report_only', true);

        $response = $this->get('/tentang');

        $response->assertStatus(200);
        $this->assertTrue($response->headers->has('Content-Security-Policy-Report-Only'));
        $this->assertFalse($response->headers->has('Content-Security-Policy'));

        $csp = $response->headers->get('Content-Security-Policy-Report-Only');

        // Core directives
        $this->assertStringContainsString("default-src 'self'", $csp);
        $this->assertStringContainsString("object-src 'none'", $csp);
        $this->assertStringContainsString("base-uri 'self'", $csp);
        $this->assertStringContainsString("form-action 'self'", $csp);

        // YouTube Lite-Embed Frame & Thumbnails
        $this->assertStringContainsString('https://www.youtube-nocookie.com', $csp);
        $this->assertStringContainsString('https://youtube-nocookie.com', $csp);
        $this->assertStringContainsString('https://img.youtube.com', $csp);
        $this->assertStringContainsString('https://i.ytimg.com', $csp);

        // Leaflet CSS, JS, and Marker Icons
        $this->assertStringContainsString('https://unpkg.com', $csp);

        // Esri & OpenStreetMap Tile Providers
        $this->assertStringContainsString('https://server.arcgisonline.com', $csp);
        $this->assertStringContainsString('https://*.tile.openstreetmap.org', $csp);

        // Google Fonts
        $this->assertStringContainsString('https://fonts.googleapis.com', $csp);
        $this->assertStringContainsString('https://fonts.gstatic.com', $csp);

        // Google Analytics
        $this->assertStringContainsString('https://www.googletagmanager.com', $csp);
        $this->assertStringContainsString('https://www.google-analytics.com', $csp);

        // Filament / Alpine / Blade Inline Requirements
        $this->assertStringContainsString("'unsafe-inline'", $csp);
        $this->assertStringContainsString("'unsafe-eval'", $csp);

        // Verify NO unsafe wildcard '*' in source lists
        $this->assertStringNotContainsString("script-src *", $csp);
        $this->assertStringNotContainsString("frame-src *", $csp);
        $this->assertStringNotContainsString("img-src *", $csp);
        $this->assertStringNotContainsString("connect-src *", $csp);
    }

    public function test_csp_header_switches_to_enforced_mode_when_report_only_is_false(): void
    {
        Config::set('app.csp_enabled', true);
        Config::set('app.csp_report_only', false);

        $response = $this->get('/tentang');

        $response->assertStatus(200);
        $this->assertTrue($response->headers->has('Content-Security-Policy'));
        $this->assertFalse($response->headers->has('Content-Security-Policy-Report-Only'));

        $csp = $response->headers->get('Content-Security-Policy');
        $this->assertStringContainsString("default-src 'self'", $csp);
        $this->assertStringContainsString('https://www.youtube-nocookie.com', $csp);
    }

    public function test_csp_header_can_be_disabled_via_config(): void
    {
        Config::set('app.csp_enabled', false);

        $response = $this->get('/tentang');

        $response->assertStatus(200);
        $this->assertFalse($response->headers->has('Content-Security-Policy'));
        $this->assertFalse($response->headers->has('Content-Security-Policy-Report-Only'));
    }

    public function test_csp_header_is_applied_to_archive_detail_and_admin_pages(): void
    {
        Config::set('app.csp_enabled', true);
        Config::set('app.csp_report_only', true);

        $province = Province::create(['name' => 'Kalimantan Barat', 'slug' => 'kalimantan-barat']);
        $regency = Regency::create([
            'province_id' => $province->id,
            'name' => 'Kapuas Hulu',
            'slug' => 'kapuas-hulu',
            'latitude' => 0.8,
            'longitude' => 112.9,
        ]);

        $item = CultureItem::create([
            'regency_id' => $regency->id,
            'title' => 'Keling Kumang',
            'slug' => 'keling-kumang',
            'category' => 'Tutur Mitos',
            'excerpt' => 'Kisah kepahlawanan dayak.',
            'description' => 'Deskripsi tuturan lengkap.',
            'youtube_id' => 'abc123xyz',
            'is_published' => true,
        ]);

        // 1. Archive detail page
        $showResponse = $this->get(route('arsip.show', $item->slug));
        $showResponse->assertStatus(200);
        $this->assertTrue($showResponse->headers->has('Content-Security-Policy-Report-Only'));

        // 2. Admin login page
        $adminResponse = $this->get('/admin/login');
        $adminResponse->assertStatus(200);
        $this->assertTrue($adminResponse->headers->has('Content-Security-Policy-Report-Only'));
    }
}
