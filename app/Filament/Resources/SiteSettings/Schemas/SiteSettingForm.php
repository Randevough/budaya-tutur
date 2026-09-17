<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Konfigurasi Donasi')
                    ->schema([
                        Toggle::make('is_donation_active')
                            ->label('Aktifkan Halaman Donasi')
                            ->helperText('Tampilkan rute dan navigasi /donasi di situs publik.')
                            ->default(true),

                        Fieldset::make('Rekening Transfer Bank')
                            ->columns(['default' => 1, 'md' => 3])
                            ->schema([
                                TextInput::make('bank_name')
                                    ->label('Nama Bank')
                                    ->placeholder('Contoh: BCA, Mandiri')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('bank_account_number')
                                    ->label('Nomor Rekening')
                                    ->required()
                                    ->maxLength(50),

                                TextInput::make('bank_account_name')
                                    ->label('Atas Nama')
                                    ->required()
                                    ->maxLength(150),
                            ]),

                        Fieldset::make('QRIS & Kontak Konfirmasi')
                            ->columns(['default' => 1, 'md' => 2])
                            ->schema([
                                TextInput::make('contact_whatsapp')
                                    ->label('Nomor WhatsApp')
                                    ->placeholder('081234567890 atau 6281234567890')
                                    ->helperText('Awalan 08 atau 62 otomatis disesuaikan untuk WhatsApp.')
                                    ->dehydrateStateUsing(fn (?string $state) => \App\Models\SiteSetting::normalizeWhatsApp($state))
                                    ->maxLength(25),

                                FileUpload::make('qris_image')
                                    ->label('Gambar Barcode QRIS')
                                    ->image()
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                                    ->maxSize(5120)
                                    ->helperText('JPG, PNG, WebP (maks. 5 MB).')
                                    ->directory('settings')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->openable()
                                    ->downloadable(),
                            ]),
                    ]),
            ]);
    }
}
