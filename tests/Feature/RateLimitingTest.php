<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Filament\Pages\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RateLimitingTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_throttles_after_five_submissions_per_minute(): void
    {
        // 5 valid submissions within 1 minute
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->post('/kontak', [
                'name' => "User {$i}",
                'email' => "user{$i}@example.com",
                'subject' => "Pesan Uji {$i}",
                'message' => "Isi pesan valid ke-{$i}",
            ]);

            $response->assertStatus(302);
            $response->assertSessionHas('success');
        }

        // 6th submission within the same minute should be throttled
        $response = $this->post('/kontak', [
            'name' => 'User 6',
            'email' => 'user6@example.com',
            'subject' => 'Pesan Uji 6',
            'message' => 'Isi pesan ke-6 yang seharusnya di-throttle',
        ]);

        $response->assertStatus(429);
    }

    public function test_contact_form_honeypot_silently_discards_bot_submissions(): void
    {
        $response = $this->post('/kontak', [
            'name' => 'Malicious Spambot',
            'email' => 'bot@spammer.org',
            'subject' => 'Viagra Discount Promo',
            'message' => 'Visit our spam pharmacy website now',
            'website_url' => 'https://spam-pharmacy.example.com', // Filled honeypot
        ]);

        // Returns fake success to deceive the automated bot
        $response->assertStatus(302);
        $response->assertSessionHas('success');

        // Verify zero record created in database
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'bot@spammer.org',
        ]);
        $this->assertEquals(0, ContactMessage::count());
    }

    public function test_archive_search_throttles_after_sixty_requests_per_minute(): void
    {
        $province = Province::create(['name' => 'Bali', 'slug' => 'bali']);
        $regency = Regency::create([
            'province_id' => $province->id,
            'name' => 'Denpasar',
            'slug' => 'denpasar',
            'latitude' => -8.65,
            'longitude' => 115.21,
        ]);

        CultureItem::create([
            'regency_id' => $regency->id,
            'title' => 'Kidung Bali',
            'slug' => 'kidung-bali',
            'category' => 'Nyanyian Sunyi',
            'excerpt' => 'Kutipan kidung...',
            'description' => 'Deskripsi kidung...',
            'youtube_id' => 'dQw4w9WgXcQ',
            'is_published' => true,
        ]);

        // 60 requests should succeed
        for ($i = 1; $i <= 60; $i++) {
            $response = $this->get('/arsip?q=bali');
            $response->assertStatus(200);
        }

        // 61st request within the same minute should receive 429 Too Many Requests
        $response = $this->get('/arsip?q=bali');
        $response->assertStatus(429);
    }

    public function test_filament_admin_login_rate_limits_after_five_failed_attempts(): void
    {
        // 5 failed login attempts
        for ($i = 1; $i <= 5; $i++) {
            Livewire::test(\App\Filament\Pages\Auth\Login::class)
                ->fillForm([
                    'email' => 'admin@budayatutur.id',
                    'password' => 'wrong-password',
                ])
                ->call('authenticate');
        }

        // 6th attempt triggers Filament's rate limiting notification
        Livewire::test(\App\Filament\Pages\Auth\Login::class)
            ->fillForm([
                'email' => 'admin@budayatutur.id',
                'password' => 'wrong-password',
            ])
            ->call('authenticate')
            ->assertNotified();
    }
}
