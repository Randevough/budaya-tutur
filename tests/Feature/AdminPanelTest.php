<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_loads_successfully(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@budayatutur.id',
        ]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_authenticated_admin_can_access_culture_items_resource(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/culture-items');
        $response->assertStatus(200);
    }

    public function test_authenticated_admin_can_access_provinces_resource(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/provinces');
        $response->assertStatus(200);
    }

    public function test_authenticated_admin_can_access_regencies_resource(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/regencies');
        $response->assertStatus(200);
    }

    public function test_authenticated_admin_can_access_contact_messages_resource(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/contact-messages');
        $response->assertStatus(200);
    }

    public function test_indonesia_wilayah_seeder_populates_38_provinces_and_514_regencies(): void
    {
        $this->seed(\Database\Seeders\IndonesiaWilayahSeeder::class);

        $this->assertDatabaseCount('provinces', 38);
        $this->assertDatabaseCount('regencies', 514);

        // Verify centroids are non-null and valid coordinates
        $alor = \App\Models\Regency::where('slug', 'kabupaten-alor')->first();
        $this->assertNotNull($alor);
        $this->assertEquals('Nusa Tenggara Timur', $alor->province->name);
        $this->assertNotNull($alor->latitude);
        $this->assertNotNull($alor->longitude);
        $this->assertNotEquals(0.0, $alor->latitude);
        $this->assertNotEquals(0.0, $alor->longitude);
    }

    public function test_authenticated_admin_can_access_culture_items_create_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/culture-items/create');
        $response->assertStatus(200);
        $response->assertSee('Identitas &amp; Asal Wilayah', false);
        $response->assertSee('Naskah &amp; Narasi Tuturan', false);
        $response->assertSee('Status Publikasi');
    }

    public function test_culture_item_form_extracts_youtube_id_correctly(): void
    {
        $expected = 'dQw4w9WgXcQ';

        $this->assertEquals($expected, \App\Filament\Resources\CultureItems\Schemas\CultureItemForm::extractYoutubeId('dQw4w9WgXcQ'));
        $this->assertEquals($expected, \App\Filament\Resources\CultureItems\Schemas\CultureItemForm::extractYoutubeId('https://www.youtube.com/watch?v=dQw4w9WgXcQ'));
        $this->assertEquals($expected, \App\Filament\Resources\CultureItems\Schemas\CultureItemForm::extractYoutubeId('https://youtu.be/dQw4w9WgXcQ'));
        $this->assertEquals($expected, \App\Filament\Resources\CultureItems\Schemas\CultureItemForm::extractYoutubeId('https://www.youtube.com/watch?v=dQw4w9WgXcQ&t=42s'));
        $this->assertEquals($expected, \App\Filament\Resources\CultureItems\Schemas\CultureItemForm::extractYoutubeId('https://youtube.com/shorts/dQw4w9WgXcQ?feature=share'));
        $this->assertEquals($expected, \App\Filament\Resources\CultureItems\Schemas\CultureItemForm::extractYoutubeId('https://www.youtube.com/embed/dQw4w9WgXcQ'));
        $this->assertNull(\App\Filament\Resources\CultureItems\Schemas\CultureItemForm::extractYoutubeId(''));
    }

    public function test_dashboard_header_action_can_toggle_donation(): void
    {
        $admin = User::factory()->create();
        \App\Models\SiteSetting::current(); // Ensure initial setting

        \Livewire\Livewire::actingAs($admin)
            ->test(\App\Filament\Pages\Dashboard::class)
            ->assertSee('Donasi: Aktif')
            ->callAction('toggle_donation');

        $this->assertFalse(\App\Models\SiteSetting::find(1)->is_donation_active);
    }
}

