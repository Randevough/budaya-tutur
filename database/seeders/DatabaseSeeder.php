<?php

namespace Database\Seeders;

use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with authentic archival oral traditions.
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

        // 2. Provinces
        $ntt = Province::firstOrCreate(
            ['slug' => 'nusa-tenggara-timur'],
            ['name' => 'Nusa Tenggara Timur']
        );

        $jatim = Province::firstOrCreate(
            ['slug' => 'jawa-timur'],
            ['name' => 'Jawa Timur']
        );

        $sumut = Province::firstOrCreate(
            ['slug' => 'sumatera-utara'],
            ['name' => 'Sumatera Utara']
        );

        $kalbar = Province::firstOrCreate(
            ['slug' => 'kalimantan-barat'],
            ['name' => 'Kalimantan Barat']
        );

        $sulsel = Province::firstOrCreate(
            ['slug' => 'sulawesi-selatan'],
            ['name' => 'Sulawesi Selatan']
        );

        $maluku = Province::firstOrCreate(
            ['slug' => 'maluku'],
            ['name' => 'Maluku']
        );

        $papua = Province::firstOrCreate(
            ['slug' => 'papua'],
            ['name' => 'Papua']
        );

        // 3. Regencies with Real Geographic Centroids
        $alor = Regency::firstOrCreate(
            ['slug' => 'kabupaten-alor'],
            [
                'province_id' => $ntt->id,
                'name' => 'Kabupaten Alor',
                'latitude' => -8.3134900,
                'longitude' => 124.6468400,
            ]
        );

        $sikka = Regency::firstOrCreate(
            ['slug' => 'kabupaten-sikka'],
            [
                'province_id' => $ntt->id,
                'name' => 'Kabupaten Sikka',
                'latitude' => -8.6212100,
                'longitude' => 122.2173100,
            ]
        );

        $banyuwangi = Regency::firstOrCreate(
            ['slug' => 'kabupaten-banyuwangi'],
            [
                'province_id' => $jatim->id,
                'name' => 'Kabupaten Banyuwangi',
                'latitude' => -8.2192330,
                'longitude' => 114.3692260,
            ]
        );

        $toba = Regency::firstOrCreate(
            ['slug' => 'kabupaten-toba'],
            [
                'province_id' => $sumut->id,
                'name' => 'Kabupaten Toba',
                'latitude' => 2.3853000,
                'longitude' => 99.0706000,
            ]
        );

        $kapuasHulu = Regency::firstOrCreate(
            ['slug' => 'kabupaten-kapuas-hulu'],
            [
                'province_id' => $kalbar->id,
                'name' => 'Kabupaten Kapuas Hulu',
                'latitude' => 0.8143000,
                'longitude' => 112.7667000,
            ]
        );

        $toraja = Regency::firstOrCreate(
            ['slug' => 'kabupaten-tana-toraja'],
            [
                'province_id' => $sulsel->id,
                'name' => 'Kabupaten Tana Toraja',
                'latitude' => -3.0975000,
                'longitude' => 119.8828000,
            ]
        );

        $malukuTengah = Regency::firstOrCreate(
            ['slug' => 'kabupaten-maluku-tengah'],
            [
                'province_id' => $maluku->id,
                'name' => 'Kabupaten Maluku Tengah',
                'latitude' => -3.3138000,
                'longitude' => 128.9669000,
            ]
        );

        $jayapura = Regency::firstOrCreate(
            ['slug' => 'kabupaten-jayapura'],
            [
                'province_id' => $papua->id,
                'name' => 'Kabupaten Jayapura',
                'latitude' => -2.5769000,
                'longitude' => 140.5167000,
            ]
        );

        // 4. Archival Culture Items
        CultureItem::firstOrCreate(
            ['slug' => 'tutur-lisan-lego-lego-alor'],
            [
                'regency_id' => $alor->id,
                'title' => 'Tutur Lisan Lego-Lego',
                'category' => 'Syair & Tari Tradisional',
                'excerpt' => 'Lego-lego adalah tarian dan tuturan persatuan masyarakat Alor yang dilantunkan secara melingkar mengelilingi mesbah megalitik mesjid/gereja tradisional.',
                'description' => "Tradisi Lego-Lego di Alor bukan sekadar gerak badan, melainkan tuturan sejarah silsilah suku-suku, rekonsiliasi antar kampung, serta pujian kepada leluhur dan Sang Pencipta.\n\nDilantunkan dalam bahasa-bahasa tanah yang sudah langka oleh tetua adat (Pawang Lego-Lego) sambil menghentakkan kaki serentak beralaskan tanah adat.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        CultureItem::firstOrCreate(
            ['slug' => 'nyanyian-panen-sikka-dok-hek'],
            [
                'regency_id' => $sikka->id,
                'title' => 'Nyanyian Ratap & Sukacita Dok Hek',
                'category' => 'Nyanyian Adat',
                'excerpt' => 'Pelantunan bait-bait syukur saat pemetikan padi gogo di perbukitan Maumere.',
                'description' => "Dok Hek adalah tradisi vokal polifonik tanpa iringan musik alat tabuh, melambangkan kebersamaan kaum perempuan saat menuai padi dan menjaga ingatan musim.\n\nSetiap larik dinyanyikan secara bersahut-sahutan dari satu lereng ke lereng perbukitan lainnya.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        CultureItem::firstOrCreate(
            ['slug' => 'mantra-gandrung-osing-banyuwangi'],
            [
                'regency_id' => $banyuwangi->id,
                'title' => 'Kidung Seblang & Tutur Osing',
                'category' => 'Mantra & Kidung',
                'excerpt' => 'Kidung sakral ritual Seblang dalam tradisi tutur masyarakat adat Osing Banyuwangi.',
                'description' => "Pelantunan kidung-kidung kuno masyarakat Osing sebagai sarana tolak bala dan penyucian ruang batin desa.\n\nDilantunkan dengan intonasi magis dan khidmat oleh para sesepuh desa untuk menjaga keselarasan antara warga dan alam.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        CultureItem::firstOrCreate(
            ['slug' => 'umpasa-tonggo-tonggo-batak-toba'],
            [
                'regency_id' => $toba->id,
                'title' => 'Umpasa & Tonggo-Tonggo Batak Toba',
                'category' => 'Sastra Lisan & Doa Adat',
                'excerpt' => 'Untaian petuah berima Batak Toba yang memuat kebijaksanaan hidup, restu leluhur, dan ikatan kekerabatan dalihan na tolu.',
                'description' => "Umpasa adalah peribahasa puitis dan tuturan filosofis yang dilantunkan secara berbalas dalam berbagai upacara adat Batak Toba.\n\nSedangkan Tonggo-Tonggo merupakan doa dan pujian khidmat yang ditujukan kepada Mula Jadi Na Bolon serta leluhur untuk meminta perlindungan dan berkat kehidupan.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        CultureItem::firstOrCreate(
            ['slug' => 'takna-lawe-dayak-kayan'],
            [
                'regency_id' => $kapuasHulu->id,
                'title' => 'Wiracarita Takna\' Lawe\' Dayak Kayan',
                'category' => 'Wiracarita Lisan',
                'excerpt' => 'Epos lisan kuno masyarakat Dayak Kayan tentang kepahlawanan, kosmologi rimba Borneo, dan etika persaudaraan alam.',
                'description' => "Takna' Lawe' adalah wiracarita kepahlawanan lisan suku Dayak Kayan dan Dayak Kenyah di hulu Sungai Kapuas.\n\nKisah ini dituturkan oleh penutur lisan pilihan selama berjam-jam pada malam hari di rumah panjang (betang) tanpa naskah tulisan.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        CultureItem::firstOrCreate(
            ['slug' => 'singgi-badong-rambu-solo-toraja'],
            [
                'regency_id' => $toraja->id,
                'title' => 'Singgi\' & Badong Kedukaan Toraja',
                'category' => 'Syair Ritual Kematian',
                'excerpt' => 'Kidung ratapan lisan dan puji-pujian sakral dalam upacara pemakaman adat Rambu Solo\' di tanah Toraja.',
                'description' => "Singgi' adalah pidato puitis sakral dengan register bahasa tinggi (basa to minaa) pada prosesi agung Rambu Solo'.\n\nDilantunkan serempak dalam lingkaran tarian Badong oleh para tetua untuk mengantarkan arwah leluhur menuju alam keabadian Puya.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        CultureItem::firstOrCreate(
            ['slug' => 'kapata-bahasa-tanah-maluku-tengah'],
            [
                'regency_id' => $malukuTengah->id,
                'title' => 'Kapata & Kidung Bahasa Tanah Saparua',
                'category' => 'Bahasa Tanah & Kidung Adat',
                'excerpt' => 'Kidung bahasa tanah kuno Maluku yang melantunkan persaudaraan pela gandong dan memori pelayaran bahari nenek moyang.',
                'description' => "Kapata adalah sastra lisan berpola kidung puitis yang dilantunkan dalam 'bahasa tanah'—bahasa asli kepulauan Maluku yang sakral dan tak lagi digunakan dalam percakapan harian.\n\nMerekam ikrar perdamaian adat antar negeri dan sejarah pelayaran para kapitan.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );

        CultureItem::firstOrCreate(
            ['slug' => 'tutur-suku-sentani-jayapura'],
            [
                'regency_id' => $jayapura->id,
                'title' => 'Tuturan Asal-Usul Suku Sentani',
                'category' => 'Mitos Asal-Usul',
                'excerpt' => 'Rekaman kidung lisan penanda hak ulayat dan silsilah suku adat Sentani di pesisir danau Jayapura.',
                'description' => "Mitos dan silsilah lisan perpindahan klan-klan Sentani yang dinyanyikan secara turun-temurun di perairan danau Sentani.\n\nTuturan ini merupakan bukti hukum adat tak tertulis atas kepemilikan tanah adat dan wilayah penangkapan ikan leluhur.",
                'youtube_id' => 'dQw4w9WgXcQ',
                'is_published' => true,
            ]
        );
    }
}
