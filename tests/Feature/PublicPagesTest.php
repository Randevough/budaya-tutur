<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    private CultureItem $cultureItem;
    private Regency $regency;
    private Province $province;

    protected function setUp(): void
    {
        parent::setUp();

        $this->province = Province::create([
            'name' => 'Nusa Tenggara Timur',
            'slug' => 'nusa-tenggara-timur',
        ]);

        $this->regency = Regency::create([
            'province_id' => $this->province->id,
            'name' => 'Kabupaten Alor',
            'slug' => 'kabupaten-alor',
            'latitude' => -8.3134900,
            'longitude' => 124.6468400,
        ]);

        $this->cultureItem = CultureItem::create([
            'regency_id' => $this->regency->id,
            'title' => 'Tutur Lisan Lego-Lego',
            'slug' => 'tutur-lisan-lego-lego',
            'category' => 'Syair Adat',
            'excerpt' => 'Kidung persatuan suku Alor.',
            'description' => 'Tradisi tutur lisan leluhur Alor...',
            'youtube_id' => 'dQw4w9WgXcQ',
            'is_published' => true,
        ]);
    }

    public function test_homepage_loads_successfully_with_data(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Menjaga yang Terucap');
        $response->assertSee('Tutur Lisan Lego-Lego');
        $response->assertSee('culture-map');
    }

    public function test_galleries_catalog_page_displays_items_and_filters(): void
    {
        $response = $this->get('/galleries');

        $response->assertStatus(200);
        $response->assertSee('Arsip Suara Nusantara');
        $response->assertSee('Tutur Lisan Lego-Lego');

        // Test search filter
        $searchResponse = $this->get('/galleries?q=Lego-Lego');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Tutur Lisan Lego-Lego');

        // Test filter with no match
        $emptyResponse = $this->get('/galleries?q=NonExistentWord');
        $emptyResponse->assertStatus(200);
        $emptyResponse->assertSee('Tidak ada rekaman');
    }

    public function test_culture_item_detail_page_loads_with_lite_embed(): void
    {
        $response = $this->get('/galleries/' . $this->cultureItem->slug);

        $response->assertStatus(200);
        $response->assertSee($this->cultureItem->title);
        $response->assertSee('data-youtube-id="dQw4w9WgXcQ"', false);
        $response->assertSee('Kabupaten Alor');
    }

    public function test_contact_form_saves_to_database_and_catches_mail(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Maria Rambu',
            'email' => 'maria@example.com',
            'subject' => 'Usulan Kidung Sumba',
            'message' => 'Kami memiliki rekaman kidung penanaman jagung tradisi Sumba Timur.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Maria Rambu',
            'email' => 'maria@example.com',
            'subject' => 'Usulan Kidung Sumba',
        ]);
    }

    public function test_contact_form_honeypot_ignores_spambots(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Spambot',
            'email' => 'bot@spam.com',
            'message' => 'Buy cheap viagra now',
            'website_url' => 'https://spam-link.com', // Honeypot filled
        ]);

        $response->assertRedirect();
        $this->assertDatabaseMissing('contact_messages', [
            'name' => 'Spambot',
        ]);
    }

    public function test_invalid_culture_item_slug_renders_editorial_404_page(): void
    {
        $response = $this->get('/galleries/invalid-non-existent-slug');

        $response->assertStatus(404);
        $response->assertSee('Suara yang Dicari Telah Senyap');
        $response->assertSee('Galat 404');
    }

    public function test_galleries_catalog_filters_by_province(): void
    {
        $response = $this->get('/galleries?province=nusa-tenggara-timur');

        $response->assertStatus(200);
        $response->assertSee('Tutur Lisan Lego-Lego');

        $responseEmpty = $this->get('/galleries?province=non-existent-province');
        $responseEmpty->assertStatus(200);
        $responseEmpty->assertSee('Tidak ada rekaman yang sesuai');
    }

    public function test_pages_render_seo_social_meta_and_json_ld_schema(): void
    {
        // 1. Home page checks
        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('<link rel="canonical"', false);
        $home->assertSee('Budaya Tutur Voices', false);
        $home->assertSee('"@type": "Organization"', false);

        // 2. Detail page checks
        $detail = $this->get('/galleries/' . $this->cultureItem->slug);
        $detail->assertStatus(200);
        $detail->assertSee('twitter:card', false);
        $detail->assertSee('og:title', false);
        $detail->assertSee('"@type": "AudioObject"', false);
        $detail->assertSee($this->cultureItem->title, false);
    }
}

