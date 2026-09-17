<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class DonationPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_donation_page_loads_successfully_when_active(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'is_donation_active' => true,
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_number' => '123-456-7890',
                'bank_account_name' => 'Yayasan Budaya Tutur Nusantara',
            ]
        );

        $response = $this->get('/donasi');

        $response->assertStatus(200);
        $response->assertSee('Dukung Pengarsipan');
        $response->assertSee('Bank Central Asia (BCA)');
        $response->assertSee('123-456-7890');
        $response->assertSee('Yayasan Budaya Tutur Nusantara');
    }

    public function test_donation_page_returns_404_when_deactivated(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'is_donation_active' => false,
            ]
        );

        $response = $this->get('/donasi');

        $response->assertStatus(404);
    }

    public function test_navigation_displays_donation_links_only_when_active(): void
    {
        // When active
        SiteSetting::updateOrCreate(['id' => 1], ['is_donation_active' => true]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(route('donasi'));

        // When deactivated
        SiteSetting::updateOrCreate(['id' => 1], ['is_donation_active' => false]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee(route('donasi'));
    }

    public function test_admin_can_access_site_settings_resource(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/site-settings');
        // ListSiteSettings redirects directly to edit page
        $response->assertRedirect('/admin/site-settings/1/edit');

        $editResponse = $this->actingAs($admin)->get('/admin/site-settings/1/edit');
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Aktifkan Halaman Donasi');
    }
}
