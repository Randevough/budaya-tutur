<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['default' => 1, 'lg' => 2])
            ->components([
                Group::make([
                    Section::make('Status Halaman Donasi')
                        ->description('Kontrol visibilitas halaman donasi di situs publik.')
                        ->icon(Heroicon::OutlinedHeart)
                        ->schema([
                            Toggle::make('is_donation_active')
                                ->label('Halaman Donasi Aktif')
                                ->helperText('Jika diaktifkan, menu navigasi "Donasi" akan tampil dan rute /donasi dapat diakses publik. Jika dinonaktifkan, rute /donasi akan mengembalikan halaman 404.')
                                ->default(true),
                        ]),

                    Section::make('Kontak Konfirmasi')
                        ->description('Informasi kontak alternatif untuk calon donatur.')
                        ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                        ->schema([
                            TextInput::make('contact_whatsapp')
                                ->label('Nomor WhatsApp Admin (Format 628...)')
                                ->helperText('Digunakan untuk tautan konfirmasi sukarela donasi di halaman donasi.')
                                ->maxLength(20),
                        ]),
                ]),

                Group::make([
                    Section::make('Informasi Rekening & QRIS')
                        ->description('Data transaksi resmi yang ditampilkan pada halaman donasi.')
                        ->icon(Heroicon::OutlinedCreditCard)
                        ->schema([
                            TextInput::make('bank_name')
                                ->label('Nama Bank')
                                ->required()
                                ->maxLength(100),

                            TextInput::make('bank_account_number')
                                ->label('Nomor Rekening')
                                ->required()
                                ->maxLength(50),

                            TextInput::make('bank_account_name')
                                ->label('Atas Nama Rekening')
                                ->required()
                                ->maxLength(150),

                            FileUpload::make('qris_image')
                                ->label('Gambar Barcode QRIS')
                                ->helperText('Unggah gambar QR code QRIS beresolusi jelas (JPG/PNG/WEBP).')
                                ->image()
                                ->directory('settings')
                                ->disk('public')
                                ->visibility('public'),
                        ]),
                ]),
            ]);
    }
}
