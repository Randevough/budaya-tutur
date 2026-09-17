<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
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
                            ->helperText('Tampilkan halaman /donasi di situs publik.')
                            ->default(true),

                        Grid::make(['default' => 1, 'md' => 3])
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

                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextInput::make('contact_whatsapp')
                                    ->label('Nomor WhatsApp')
                                    ->placeholder('628xxxxxxxxxx')
                                    ->maxLength(20),

                                FileUpload::make('qris_image')
                                    ->label('Gambar QRIS')
                                    ->image()
                                    ->directory('settings')
                                    ->disk('public')
                                    ->visibility('public'),
                            ]),
                    ]),
            ]);
    }
}
