<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Rincian Pesan Masuk')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->description('Pesan yang dikirim oleh pengunjung melalui formulir kontak publik')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Pengirim')
                            ->disabled(),

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->disabled(),

                        TextInput::make('subject')
                            ->label('Subjek Pesan')
                            ->disabled()
                            ->columnSpanFull(),

                        Textarea::make('message')
                            ->label('Isi Pesan Lengkap')
                            ->rows(6)
                            ->disabled()
                            ->columnSpanFull(),

                        Toggle::make('is_sent_via_smtp')
                            ->label('Berhasil Dikirim via SMTP Email')
                            ->helperText('Jika non-aktif, pesan tersimpan aman di database sebagai fallback saat server SMTP offline')
                            ->disabled(),
                    ]),
            ]);
    }
}
