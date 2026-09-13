<?php

namespace Tests\Feature;

use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelRelationTest extends TestCase
{
    use RefreshDatabase;

    public function test_models_and_relationships_work_correctly(): void
    {
        $province = Province::create([
            'name' => 'Nusa Tenggara Timur',
            'slug' => 'nusa-tenggara-timur',
        ]);

        $regency = Regency::create([
            'province_id' => $province->id,
            'name' => 'Kabupaten Alor',
            'slug' => 'kabupaten-alor',
            'latitude' => -8.31349,
            'longitude' => 124.64684,
        ]);

        $item = CultureItem::create([
            'regency_id' => $regency->id,
            'title' => 'Tutur Lisan Lego-Lego',
            'slug' => 'tutur-lisan-lego-lego',
            'category' => 'Syair',
            'description' => 'Deskripsi tutur lisan...',
            'youtube_id' => 'dQw4w9WgXcQ',
            'is_published' => true,
        ]);

        // Assert relationships
        $this->assertEquals('Nusa Tenggara Timur', $regency->province->name);
        $this->assertCount(1, $regency->cultureItems);
        $this->assertEquals('Kabupaten Alor', $item->regency->name);
        $this->assertCount(1, $province->cultureItems);

        // Assert map scope
        $activeRegencies = Regency::withPublishedItems()->get();
        $this->assertCount(1, $activeRegencies);
        $this->assertEquals('Kabupaten Alor', $activeRegencies->first()->name);

        // Assert YouTube accessors
        $this->assertStringContainsString('dQw4w9WgXcQ', $item->thumbnail_url);
        $this->assertStringContainsString('youtube-nocookie.com', $item->youtube_embed_url);
    }
}
