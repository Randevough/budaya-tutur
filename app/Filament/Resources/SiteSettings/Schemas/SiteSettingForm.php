<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['default' => 1, 'lg' => 2])
            ->components([
                Group::make([
                    Section::make('Status & Kontak')
                        ->schema([
                            Toggle::make('is_donation_active')
                                ->label('Aktifkan Halaman Donasi')
                                ->helperText('Tampilkan halaman /donasi di situs publik.')
                                ->default(true),

                            TextInput::make('contact_whatsapp')
                                ->label('Nomor WhatsApp')
                                ->placeholder('628xxxxxxxxxx')
                                ->maxLength(20),
                        ]),
                ]),

                Group::make([
                    Section::make('Rekening & QRIS')
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
