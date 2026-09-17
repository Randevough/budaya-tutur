<?php

namespace App\Filament\Resources\Regencies\Schemas;

use App\Models\Province;
use App\Models\Regency;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class RegencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Wilayah')
                    ->description('Nama wilayah administratif dan provinsi naungannya di Indonesia')
                    ->icon(Heroicon::OutlinedBuildingOffice2)
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('province_id')
                            ->label('Provinsi Induk')
                            ->relationship('province', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Otomatis terpilih jika nama kabupaten/kota terdeteksi'),

                        TextInput::make('name')
                            ->label('Nama Kabupaten / Kota')
                            ->placeholder('Contoh: Kampar atau Kota Dumai')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, callable $set, callable $get) {
                                if (blank($state)) {
                                    return;
                                }

                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }

                                // Auto-lookup coordinates and province
                                $match = static::lookupCoordinates($state);
                                if ($match) {
                                    $set('latitude', $match['latitude']);
                                    $set('longitude', $match['longitude']);

                                    // Auto-set province if not yet chosen
                                    if (!$get('province_id') && !empty($match['province_slug'])) {
                                        $prov = Province::where('slug', $match['province_slug'])->first();
                                        if ($prov) {
                                            $set('province_id', $prov->id);
                                        }
                                    }

                                    Notification::make()
                                        ->title('Koordinat Terisi Otomatis')
                                        ->body("{$match['name']}: Lat {$match['latitude']}, Lng {$match['longitude']}")
                                        ->success()
                                        ->send();
                                }
                            })
                            ->suffixAction(
                                Action::make('lookupCoords')
                                    ->icon(Heroicon::OutlinedMapPin)
                                    ->tooltip('Cari dan isi koordinat otomatis')
                                    ->action(function (callable $get, callable $set) {
                                        $name = $get('name');
                                        if (blank($name)) {
                                            Notification::make()
                                                ->title('Masukkan Nama Daerah')
                                                ->body('Ketik nama kabupaten/kota terlebih dahulu.')
                                                ->warning()
                                                ->send();
                                            return;
                                        }

                                        $match = static::lookupCoordinates($name);
                                        if ($match) {
                                            $set('latitude', $match['latitude']);
                                            $set('longitude', $match['longitude']);

                                            if (!$get('province_id') && !empty($match['province_slug'])) {
                                                $prov = Province::where('slug', $match['province_slug'])->first();
                                                if ($prov) {
                                                    $set('province_id', $prov->id);
                                                }
                                            }

                                            Notification::make()
                                                ->title('Koordinat Ditemukan Otomatis')
                                                ->body("{$match['name']}: Lat {$match['latitude']}, Lng {$match['longitude']}")
                                                ->success()
                                                ->send();
                                        } else {
                                            Notification::make()
                                                ->title('Koordinat Tidak Ditemukan')
                                                ->body('Silakan periksa ejaan nama daerah atau pilih titik langsung di peta.')
                                                ->warning()
                                                ->send();
                                        }
                                    })
                            ),

                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(Regency::class, 'slug', ignoreRecord: true)
                            ->columnSpanFull()
                            ->suffixAction(
                                Action::make('generateSlug')
                                    ->icon(Heroicon::OutlinedArrowPath)
                                    ->tooltip('Hasilkan ulang slug dari nama')
                                    ->action(function (callable $get, callable $set) {
                                        $name = $get('name');
                                        if (filled($name)) {
                                            $set('slug', Str::slug($name));
                                        }
                                    })
                            ),
                    ]),

                Section::make('Titik Peta & Koordinat Centroid')
                    ->description('Tentukan posisi titik tengah kabupaten/kota dengan klik di peta atau geser pin')
                    ->icon(Heroicon::OutlinedMapPin)
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        ViewField::make('map_picker')
                            ->view('filament.components.map-picker')
                            ->columnSpanFull(),

                        TextInput::make('latitude')
                            ->label('Latitude Centroid')
                            ->placeholder('Otomatis terisi saat klik peta...')
                            ->helperText('Garis lintang (contoh: 0.3199733)')
                            ->required()
                            ->numeric(),

                        TextInput::make('longitude')
                            ->label('Longitude Centroid')
                            ->placeholder('Otomatis terisi saat klik peta...')
                            ->helperText('Garis bujur (contoh: 101.0617123)')
                            ->required()
                            ->numeric(),
                    ]),
            ]);
    }

    /**
     * Look up coordinates from local master JSON or OpenStreetMap Nominatim fallback.
     */
    public static function lookupCoordinates(string $input): ?array
    {
        $clean = strtolower(trim($input));
        if (empty($clean)) {
            return null;
        }

        $stripped = preg_replace('/^(kabupaten|kota)\s+/i', '', $clean);

        // 1. Check local master dataset (offline, instant)
        $jsonPath = database_path('data/indonesia_wilayah.json');
        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);
            $provMap = [];
            foreach ($data['provinces'] ?? [] as $p) {
                $provMap[$p['code']] = $p['slug'];
            }

            if (!empty($data['regencies'])) {
                foreach ($data['regencies'] as $r) {
                    $regName = strtolower($r['name']);
                    $regStripped = preg_replace('/^(kabupaten|kota)\s+/i', '', $regName);

                    if ($stripped === $regStripped || $clean === $regName) {
                        return [
                            'name' => $r['name'],
                            'latitude' => $r['latitude'],
                            'longitude' => $r['longitude'],
                            'province_slug' => $provMap[$r['province_code']] ?? null,
                        ];
                    }
                }
            }
        }

        // 2. Fallback to OpenStreetMap Nominatim geocoding (online)
        try {
            $query = urlencode($input . ', Indonesia');
            $opts = [
                'http' => [
                    'header' => "User-Agent: BudayaTuturVoices/1.0\r\n",
                    'timeout' => 4,
                ],
            ];
            $context = stream_context_create($opts);
            $res = @file_get_contents("https://nominatim.openstreetmap.org/search?q={$query}&format=json&limit=1", false, $context);
            if ($res) {
                $json = json_decode($res, true);
                if (!empty($json[0]['lat']) && !empty($json[0]['lon'])) {
                    return [
                        'name' => $input,
                        'latitude' => round((float) $json[0]['lat'], 7),
                        'longitude' => round((float) $json[0]['lon'], 7),
                        'province_slug' => null,
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Ignore online geocoding network errors
        }

        return null;
    }
}
