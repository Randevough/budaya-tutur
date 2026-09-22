<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Models\ContactMessage;
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
            ->recordAction('view')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pengirim')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (ContactMessage $record): string => $record->email),

                TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable()
                    ->copyable()
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->visibleFrom('md'),

                TextColumn::make('subject')
                    ->label('Subjek Pesan')
                    ->searchable()
                    ->limit(35)
                    ->tooltip(fn (ContactMessage $record): string => $record->subject)
                    ->color('gray'),

                TextColumn::make('is_sent_via_smtp')
                    ->label('Status')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Terkirim Email' : 'Fallback DB')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'warning'),

                TextColumn::make('created_at')
                    ->label('Waktu Diterima')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->visibleFrom('lg'),
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
                    ->icon(Heroicon::OutlinedEye)
                    ->modalHeading('Rincian Pesan Masuk')
                    ->modalWidth('2xl'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
