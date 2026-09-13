<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::firstOrCreate(
            ['email' => 'admin@budayatutur.id'],
            [
                'name' => 'Admin Budaya Tutur',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Sample Province: Nusa Tenggara Timur
        $ntt = \App\Models\Province::firstOrCreate(
            ['slug' => 'nusa-tenggara-timur'],
            ['name' => 'Nusa Tenggara Timur']
        );

        // Sample Province: Jawa Timur
        $jatim = \App\Models\Province::firstOrCreate(
            ['slug' => 'jawa-timur'],
            ['name' => 'Jawa Timur']
        );

        // Sample Regencies with centroids
        $alor = \App\Models\Regency::firstOrCreate(
            ['slug' => 'kabupaten-alor'],
            [
                'province_id' => $ntt->id,
                'name' => 'Kabupaten Alor',
                'latitude' => -8.3134900,
                'longitude' => 124.6468400,
            ]
        );

        $sikka = \App\Models\Regency::firstOrCreate(
            ['slug' => 'kabupaten-sikka'],
            [
                'province_id' => $ntt->id,
                'name' => 'Kabupaten Sikka',
                'latitude' => -8.6212100,
                'longitude' => 122.2173100,
            ]
        );

        $banyuwangi = \App\Models\Regency::firstOrCreate(
            ['slug' => 'kabupaten-banyuwangi'],
            [
                'province_id' => $jatim->id,
                'name' => 'Kabupaten Banyuwangi',
                'latitude' => -8.2192330,
                'longitude' => 114.3692260,
            ]
        );

        // Sample Culture Items
        \App\Models\CultureItem::firstOrCreate(
            ['slug' => 'tutur-lisan-lego-lego-alor'],
            [
                'regency_id' => $alor->id,
                'title' => 'Tutur Lisan Lego-Lego',
                'category' => 'Syair & Tari Tradisional',
                'excerpt' => 'Lego-lego adalah tarian dan tuturan persatuan masyarakat Alor yang dilantunkan secara melingkar mengelilingi mesbah megalitik mesjid/gereja tradisional.',
                'description' => 'Tradisi Lego-Lego di Alor bukan sekadar gerak badan, melainkan tuturan sejarah silsilah suku-suku, rekonsiliasi antar kampung, serta pujian kepada leluhur dan Sang Pencipta. Dilantunkan dalam bahasa-bahasa tanah yang sudah langka oleh tetua adat (Pawang Lego-Lego).',
                'youtube_id' => 'dQw4w9WgXcQ', // Sample placeholder video ID
                'is_published' => true,
            ]
        );

        \App\Models\CultureItem::firstOrCreate(
            ['slug' => 'nyanyian-panen-sikka-dok-hek'],
            [
                'regency_id' => $sikka->id,
                'title' => 'Nyanyian Ratap & Sukacita Dok Hek',
                'category' => 'Nyanyian Adat',
                'excerpt' => 'Pelantunan bait-bait syukur saat pemetikan padi gogo di perbukitan Maumere.',
                'description' => 'Dok Hek adalah tradisi vokal polifonik tanpa iringan musik alat tabuh, melambangkan kebersamaan kaum perempuan saat menuai padi dan menjaga ingatan musim.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        \App\Models\CultureItem::firstOrCreate(
            ['slug' => 'mantra-gandrung-osing-banyuwangi'],
            [
                'regency_id' => $banyuwangi->id,
                'title' => 'Kidung Seblang & Tutur Osing',
                'category' => 'Mantra & Kidung',
                'excerpt' => 'Kidung sakral ritual Seblang dalam tradisi tutur masyarakat adat Osing Banyuwangi.',
                'description' => 'Pelantunan kidung-kidung kuno masyarakat Osing sebagai sarana tolak bala dan penyucian ruang batin desa, dilantunkan dengan intonasi magis dan khidmat.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );
    }
}
