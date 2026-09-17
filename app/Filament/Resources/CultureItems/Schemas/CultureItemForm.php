<?php

namespace App\Filament\Resources\CultureItems\Schemas;

use App\Models\CultureItem;
use App\Models\Regency;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class CultureItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas & Asal Wilayah')
                    ->description('Informasi judul arsip dan asal wilayah administratif di nusantara')
                    ->icon(Heroicon::OutlinedDocumentText)
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Budaya Tutur')
                            ->placeholder('Contoh: Tradisi Lisan Pasola')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, callable $set) {
                                if ($operation === 'create' && filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->helperText('Digunakan untuk tautan publik (/arsip/slug). Otomatis terisi saat membuat baru.')
                            ->required()
                            ->unique(CultureItem::class, 'slug', ignoreRecord: true)
                            ->suffixAction(
                                Action::make('generateSlug')
                                    ->icon(Heroicon::OutlinedArrowPath)
                                    ->tooltip('Hasilkan ulang slug dari judul')
                                    ->action(function (callable $get, callable $set) {
                                        $title = $get('title');
                                        if (filled($title)) {
                                            $set('slug', Str::slug($title));
                                        }
                                    })
                            ),

                        Select::make('regency_id')
                            ->label('Kabupaten / Kota Asal')
                            ->relationship('regency', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Regency $record) => "{$record->name} ({$record->province?->name})")
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Pilih kabupaten/kota tempat tuturan ini berasal untuk penempatan titik peta')
                            ->columnSpanFull(),
                    ]),

                Section::make('Naskah & Narasi Tuturan')
                    ->description('Transkripsi tuturan lisan, konteks filosofis, dan intisari rekaman')
                    ->icon(Heroicon::OutlinedBookOpen)
                    ->schema([
                        Textarea::make('excerpt')
                            ->label('Ringkasan Singkat (Kutipan Kurasi)')
                            ->rows(3)
                            ->helperText('Ringkasan 1-2 kalimat untuk pratinjau kartu katalog arsip')
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi & Naskah Tutur Lengkap')
                            ->rows(10)
                            ->required()
                            ->helperText('Transkripsi lisan, konteks kultural, makna filosofis, atau latar belakang tuturan')
                            ->columnSpanFull(),
                    ]),

                Section::make('Media Suara & Status Publikasi')
                    ->description('Pengaturan embed audio/video YouTube dan foto kurasi')
                    ->icon(Heroicon::OutlinedPlayCircle)
                    ->columns(2)
                    ->schema([
                        TextInput::make('youtube_id')
                            ->label('YouTube Video ID')
                            ->placeholder('Contoh: dQw4w9WgXcQ')
                            ->helperText('Masukkan 11 karakter ID video YouTube (misal: dQw4w9WgXcQ dari https://youtu.be/dQw4w9WgXcQ)')
                            ->required(),

                        Toggle::make('is_published')
                            ->label('Terbitkan ke Publik')
                            ->helperText('Jika aktif, arsip ini langsung tampil di beranda, peta, dan katalog')
                            ->default(true),

                        FileUpload::make('cover_image_path')
                            ->label('Foto Sampul Kurasi (Opsional)')
                            ->directory('covers')
                            ->image()
                            ->helperText('Biarkan kosong untuk otomatis memakai thumbnail resolusi tinggi YouTube')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
