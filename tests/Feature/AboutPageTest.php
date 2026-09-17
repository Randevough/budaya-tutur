<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;
    public function test_about_page_loads_successfully_with_editorial_sections(): void
    {
        $response = $this->get(route('about'));

        $response->assertStatus(200);
        $response->assertSee('Menjaga Tutur');
        $response->assertSee('Visi & Misi', false);
        $response->assertDontSee('Filosofi Lambang Budaya Tutur');
        $response->assertDontSee('Etika & Protokol Pengarsipan', false);
        $response->assertSee('Punya Rekaman atau Mengetahui Penutur di Daerah Anda?');
    }
}
