<?php

namespace Tests\Feature;

use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponsiveAndAccessibilityTest extends TestCase
{
    use RefreshDatabase;

    private CultureItem $cultureItem;
    private Regency $regency;
    private Province $province;

    protected function setUp(): void
    {
        parent::setUp();

        $this->province = Province::create([
            'name' => 'Sumatera Barat',
            'slug' => 'sumatera-barat',
        ]);

        $this->regency = Regency::create([
            'province_id' => $this->province->id,
            'name' => 'Kabupaten Tanah Datar',
            'slug' => 'kabupaten-tanah-datar',
            'latitude' => -0.4578,
            'longitude' => 100.5912,
        ]);

        $this->cultureItem = CultureItem::create([
            'regency_id' => $this->regency->id,
            'title' => 'Kaba Cindua Mato',
            'slug' => 'kaba-cindua-mato',
            'category' => 'Sastra Lisan',
            'excerpt' => 'Kisah epik mitologi Minangkabau.',
            'description' => 'Warisan sastra tutur dan petuah luhur Minangkabau yang dilantunkan turun-temurun.',
            'youtube_id' => 'dQw4w9WgXcQ',
            'is_published' => true,
        ]);
    }

    public function test_skip_to_content_link_is_present_on_layout(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('href="#main-content"', false);
        $response->assertSee('Lewati ke konten utama');
        $response->assertSee('id="main-content"', false);
    }

    public function test_mobile_navbar_overlay_and_accessibility_attributes(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        // Mobile toggle button has proper ARIA attributes
        $response->assertSee('aria-controls="mobile-menu-panel"', false);
        $response->assertSee('aria-expanded="false"', false);
        $response->assertSee('aria-label="Buka Menu Navigasi"', false);
        
        // Mobile menu panel has overlay classes to prevent page content shift and bleed-through
        $response->assertSee('id="mobile-menu-panel"', false);
        $response->assertSee('fixed inset-x-0 top-20 bottom-0', false);
        $response->assertSee('background-color: #0c0b0a;', false);
    }

    public function test_detail_page_has_accessible_keyboard_interactive_player(): void
    {
        $response = $this->get(route('arsip.show', $this->cultureItem->slug));

        $response->assertStatus(200);
        // Player container has accessible keyboard attributes
        $response->assertSee('role="button"', false);
        $response->assertSee('tabindex="0"', false);
        $response->assertSee('aria-label="Putar rekaman tuturan: Kaba Cindua Mato"', false);
        
        // Share action buttons have accessible labels
        $response->assertSee('Salin Link');
        $response->assertSee('WhatsApp');
    }

    public function test_arsip_catalog_page_responsive_elements(): void
    {
        $response = $this->get(route('arsip.index'));

        $response->assertStatus(200);
        // Search form accessibility
        $response->assertSee('aria-label="Cari arsip budaya tutur"', false);
        $response->assertSee('aria-label="Pilih Provinsi"', false);
        $response->assertSee('aria-haspopup="listbox"', false);
    }

    public function test_contact_form_accessibility(): void
    {
        $response = $this->get(route('kontak'));

        $response->assertStatus(200);
        // Labels for accessibility
        $response->assertSee('for="name"', false);
        $response->assertSee('for="email"', false);
        $response->assertSee('for="subject"', false);
        $response->assertSee('for="message"', false);
    }

    public function test_donation_page_responsive_elements(): void
    {
        $response = $this->get(route('donasi'));

        $response->assertStatus(200);
        $response->assertSee('break-all', false);
        $response->assertSee('font-mono', false);
        $response->assertSee('aria-label="Salin nomor rekening ke papan klip"', false);
    }
}
