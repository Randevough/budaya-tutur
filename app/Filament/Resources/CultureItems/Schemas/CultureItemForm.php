<?php

namespace App\Filament\Resources\CultureItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CultureItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('regency_id')
                    ->label('Kabupaten / Kota Asal')
                    ->relationship('regency', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('title')
                    ->label('Judul Budaya Tutur')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(\App\Models\CultureItem::class, 'slug', ignoreRecord: true),
                Textarea::make('excerpt')
                    ->label('Ringkasan Singkat')
                    ->rows(3)
                    ->helperText('Ringkasan 1-2 kalimat untuk pratinjau kartu arsip')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Deskripsi & Narasi Tutur')
                    ->rows(8)
                    ->required()
                    ->helperText('Naskah tuturan, konteks kultural, atau transkripsi lisan')
                    ->columnSpanFull(),
                TextInput::make('youtube_id')
                    ->label('YouTube Video ID')
                    ->helperText('Contoh: dQw4w9WgXcQ (11 karakter ID video YouTube untuk lite-embed)')
                    ->required(),
                FileUpload::make('cover_image_path')
                    ->label('Foto Sampul Kurasi (Opsional)')
                    ->directory('covers')
                    ->image()
                    ->helperText('Biarkan kosong jika ingin otomatis memakai thumbnail YouTube beresolusi tinggi'),
                Toggle::make('is_published')
                    ->label('Status Publikasi')
                    ->default(true),
            ]);
    }
}
