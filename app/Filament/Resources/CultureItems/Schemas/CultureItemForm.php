<?php

namespace App\Filament\Resources\CultureItems\Schemas;

use App\Models\CultureItem;
use App\Models\Regency;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class CultureItemForm
{
    /**
     * Helper to extract the 11-character YouTube video ID from various URL formats.
     */
    public static function extractYoutubeId(?string $input): ?string
    {
        if (blank($input)) {
            return null;
        }

        $input = trim($input);

        // Direct 11-char alphanumeric ID
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            return $input;
        }

        // Match common YouTube URL formats: watch?v=, youtu.be/, shorts/, embed/, etc.
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $input, $match)) {
            return $match[1];
        }

        return $input;
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['default' => 1, 'lg' => 2])
            ->components([
                // Left Column: Identitas, Wilayah & Media
                Group::make([
                    Section::make('Identitas & Asal Wilayah')
                        ->icon(Heroicon::OutlinedDocumentText)
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
                                ->label('Slug URL Publik')
                                ->prefix('/arsip/')
                                ->required()
                                ->unique(CultureItem::class, 'slug', ignoreRecord: true)
                                ->suffixAction(
                                    Action::make('generateSlug')
                                        ->icon(Heroicon::OutlinedArrowPath)
                                        ->tooltip('Hasilkan ulang dari judul')
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
                                ->getOptionLabelFromRecordUsing(fn (Regency $record) => "{$record->name} — {$record->province?->name}")
                                ->searchable()
                                ->preload()
                                ->required()
                                ->columnSpanFull(),
                        ]),

                    Section::make('Media Audio / Video & Sampul')
                        ->icon(Heroicon::OutlinedPlayCircle)
                        ->schema([
                            TextInput::make('youtube_id')
                                ->label('YouTube Video ID atau Tautan')
                                ->placeholder('Tempel tautan atau ID (misal: https://youtu.be/dQw4w9WgXcQ)')
                                ->helperText('Tautan YouTube, Shorts, atau 11 karakter ID video.')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (?string $state, callable $set) {
                                    if (filled($state)) {
                                        $extracted = CultureItemForm::extractYoutubeId($state);
                                        if ($extracted !== $state) {
                                            $set('youtube_id', $extracted);
                                        }
                                    }
                                })
                                ->dehydrateStateUsing(fn (?string $state) => CultureItemForm::extractYoutubeId($state)),

                            TextEntry::make('youtube_preview')
                                ->hiddenLabel()
                                ->html()
                                ->state(function (callable $get): ?Htmlable {
                                    $raw = $get('youtube_id');
                                    $id = CultureItemForm::extractYoutubeId($raw);

                                    if (blank($id)) {
                                        return null;
                                    }

                                    $thumbnailUrl = "https://img.youtube.com/vi/{$id}/mqdefault.jpg";

                                    return new HtmlString('
                                        <div class="overflow-hidden rounded-lg border border-stone-200 bg-stone-900 shadow-2xs">
                                            <div class="relative aspect-video w-full overflow-hidden bg-stone-950">
                                                <img src="' . e($thumbnailUrl) . '" alt="Thumbnail Video YouTube" class="h-full w-full object-cover grayscale transition duration-300 hover:grayscale-0" />
                                                <div class="absolute inset-0 flex items-center justify-center bg-black/20 pointer-events-none">
                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-stone-950/85 px-2.5 py-1 text-[11px] font-semibold text-stone-200 shadow-xs backdrop-blur-xs">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> ID: ' . e($id) . '
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between border-t border-stone-800 bg-stone-900 px-3 py-1.5 text-[11px] text-stone-300">
                                                <span class="font-medium text-stone-300">Thumbnail YouTube aktif</span>
                                                <a href="https://youtu.be/' . e($id) . '" target="_blank" rel="noopener noreferrer" class="font-medium text-stone-100 underline hover:text-white">Uji Tautan &nearr;</a>
                                            </div>
                                        </div>
                                    ');
                                }),

                            FileUpload::make('cover_image_path')
                                ->label('Foto Sampul Kurasi (Opsional)')
                                ->directory('covers')
                                ->image()
                                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                                ->maxSize(3072)
                                ->imageAspectRatio('16:9')
                                ->automaticallyCropImagesToAspectRatio()
                                ->imageResizeMode('cover')
                                ->imageResizeTargetWidth('1280')
                                ->imageResizeTargetHeight('720')
                                ->helperText('JPG, PNG, WebP (maks. 3 MB). Kosongkan untuk memakai thumbnail YouTube.')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(1),

                // Right Column: Status & Naskah Narasi
                Group::make([
                    Section::make('Status Publikasi')
                        ->icon(Heroicon::OutlinedGlobeAlt)
                        ->schema([
                            Toggle::make('is_published')
                                ->label('Terbitkan ke Publik')
                                ->helperText('Tampilkan langsung di katalog publik dan peta.')
                                ->default(true),
                        ]),

                    Section::make('Naskah & Narasi Tuturan')
                        ->icon(Heroicon::OutlinedBookOpen)
                        ->schema([
                            Textarea::make('excerpt')
                                ->label('Ringkasan Singkat (Kutipan Kurasi)')
                                ->rows(3)
                                ->placeholder('Tulis 1–2 kalimat intisari atau kutipan puitis untuk pratinjau kartu...')
                                ->helperText('Maks. 2 kalimat untuk intisari pratinjau kartu.')
                                ->columnSpanFull(),

                            Textarea::make('description')
                                ->label('Transkripsi & Naskah Tutur Lengkap')
                                ->rows(12)
                                ->placeholder("Tuliskan naskah lisan, bait-bait tuturan, atau transkripsi lengkap di sini...\n\nGunakan baris baru untuk memisahkan bait syair, nyanyian adat, mantra, atau catatan makna filosofis.")
                                ->required()
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(1),
            ]);
    }
}
