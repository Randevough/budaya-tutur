<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pengirim')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable()
                    ->copyable()
                    ->icon(Heroicon::OutlinedEnvelope),

                TextColumn::make('subject')
                    ->label('Subjek Pesan')
                    ->searchable()
                    ->limit(40)
                    ->color('gray'),

                TextColumn::make('is_sent_via_smtp')
                    ->label('Status Pengiriman')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Terkirim via Email' : 'Tersimpan di DB (Fallback)')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'warning'),

                TextColumn::make('created_at')
                    ->label('Waktu Diterima')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_sent_via_smtp')
                    ->label('Status Pengiriman')
                    ->trueLabel('Hanya Terkirim ke Email')
                    ->falseLabel('Hanya Tersimpan di Database'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Baca Pesan')
                    ->modalHeading('Rincian Pesan Kontak Masuk'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
