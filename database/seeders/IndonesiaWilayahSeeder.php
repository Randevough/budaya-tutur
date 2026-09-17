<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class IndonesiaWilayahSeeder extends Seeder
{
    /**
     * Seed all 38 Indonesian Provinces and 514 Regencies/Cities with real centroids.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/indonesia_wilayah.json');

        if (!File::exists($jsonPath)) {
            $this->command->error("Wilayah data file not found at: {$jsonPath}");
            return;
        }

        $data = json_decode(File::get($jsonPath), true);

        if (!isset($data['provinces']) || !isset($data['regencies'])) {
            $this->command->error("Invalid JSON structure in {$jsonPath}");
            return;
        }

        // 1. Seed Provinces
        $provinceMap = [];
        foreach ($data['provinces'] as $p) {
            $province = Province::firstOrCreate(
                ['slug' => $p['slug']],
                ['name' => $p['name']]
            );
            $provinceMap[$p['code']] = $province->id;
        }

        // 2. Seed Regencies
        foreach ($data['regencies'] as $r) {
            $provId = $provinceMap[$r['province_code']] ?? null;
            if (!$provId) {
                continue;
            }

            Regency::firstOrCreate(
                ['slug' => $r['slug']],
                [
                    'province_id' => $provId,
                    'name' => $r['name'],
                    'latitude' => $r['latitude'],
                    'longitude' => $r['longitude'],
                ]
            );
        }
    }
}
