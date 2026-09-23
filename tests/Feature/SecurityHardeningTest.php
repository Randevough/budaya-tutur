<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_production_environment_forces_app_debug_false(): void
    {
        // Simulate production environment
        Config::set('app.debug', true);
        $this->app['env'] = 'production';

        // Trigger AppServiceProvider boot logic
        (new \App\Providers\AppServiceProvider($this->app))->boot();

        $this->assertFalse(config('app.debug'));
    }

    public function test_all_models_have_explicit_fillable_protection(): void
    {
        $models = [
            ContactMessage::class,
            CultureItem::class,
            Province::class,
            Regency::class,
            SiteSetting::class,
            User::class,
        ];

        foreach ($models as $modelClass) {
            $model = new $modelClass;
            $fillable = $model->getFillable();
            $guarded = $model->getGuarded();

            $this->assertNotEmpty($fillable, "Model {$modelClass} must have explicit fillable attributes defined.");
            $this->assertNotEquals(['*'], $fillable, "Model {$modelClass} fillable cannot be wild-carded.");
            $this->assertNotEquals([], $guarded, "Model {$modelClass} cannot have guarded set to empty array when fillable is not protecting.");
        }
    }

    public function test_temporary_artisan_routes_require_authorization_key(): void
    {
        // 1. Without key -> 403 Forbidden
        $response = $this->get('/artisan-migrate-bt9x2w');
        $response->assertStatus(403);

        $response = $this->get('/artisan-cache-clear-bt9x2w');
        $response->assertStatus(403);

        // 2. With wrong key -> 403 Forbidden
        $response = $this->get('/artisan-migrate-bt9x2w?key=wrong-key');
        $response->assertStatus(403);

        $response = $this->get('/artisan-cache-clear-bt9x2w?key=wrong-key');
        $response->assertStatus(403);

        // 3. With correct key -> 200 OK
        $key = env('ARTISAN_WEB_KEY', 'bt9x2w-key');
        $response = $this->get("/artisan-cache-clear-bt9x2w?key={$key}");
        $response->assertStatus(200);
        $response->assertSee('Cache cleared OK');
    }

    public function test_culture_item_form_displays_upload_constraints_to_admin(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/culture-items/create');
        $response->assertStatus(200);
        $response->assertSee('Foto Sampul Kurasi (Opsional)');
        $response->assertSee('JPG, PNG, WebP (maks. 3 MB)');
    }

    public function test_json_ld_schema_safely_encodes_special_characters_and_script_tags(): void
    {
        $province = Province::create(['name' => 'Papua', 'slug' => 'papua']);
        $regency = Regency::create([
            'province_id' => $province->id,
            'name' => 'Jayapura',
            'slug' => 'jayapura',
            'latitude' => -2.5,
            'longitude' => 140.7,
        ]);

        $item = CultureItem::create([
            'regency_id' => $regency->id,
            'title' => 'Tradisi Tutur </script><script>alert("XSS")</script>',
            'slug' => 'tradisi-tutur-test-xss',
            'category' => 'Nyanyian Sunyi',
            'excerpt' => 'Kutipan tutur penting.',
            'description' => 'Deskripsi tuturan panjang.',
            'youtube_id' => 'dQw4w9WgXcQ',
            'is_published' => true,
        ]);

        $response = $this->get(route('arsip.show', $item->slug));
        $response->assertStatus(200);

        // Verify </script> inside title is safely escaped with hex unicode tags (\u003C, \u003E, \u0022) so no script tag breakouts occur
        $content = $response->getContent();
        $this->assertStringNotContainsString('</script><script>alert("XSS")</script>', $content);
        $this->assertStringContainsString('\u003C\/script\u003E\u003Cscript\u003Ealert(\u0022XSS\u0022)\u003C\/script\u003E', $content);
    }
}
