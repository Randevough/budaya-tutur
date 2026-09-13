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
}
