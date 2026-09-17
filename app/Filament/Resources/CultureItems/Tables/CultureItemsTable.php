<?php

namespace App\Filament\Resources\CultureItems\Tables;

use App\Models\CultureItem;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CultureItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image_path')
                    ->label('Sampul')
                    ->defaultImageUrl(fn (CultureItem $record): ?string => $record->youtube_id ? "https://img.youtube.com/vi/{$record->youtube_id}/mqdefault.jpg" : null)
                    ->square(),

                TextColumn::make('title')
                    ->label('Judul Budaya Tutur')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (CultureItem $record): ?string => $record->excerpt ? Str::limit($record->excerpt, 45) : null),

                TextColumn::make('regency.name')
                    ->label('Kabupaten / Kota')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('youtube_id')
                    ->label('YouTube ID')
                    ->badge()
                    ->color('zinc')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('is_published')
                    ->label('Status')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Terbit' : 'Draf')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('regency_id')
                    ->label('Wilayah Asal')
                    ->relationship('regency', 'name')
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('is_published')
                    ->label('Status Publikasi')
                    ->trueLabel('Hanya Terbit')
                    ->falseLabel('Hanya Draf'),
            ])
            ->recordActions([
                Action::make('preview')
                    ->label('Lihat di Web')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->color('gray')
                    ->url(fn (CultureItem $record): string => route('arsip.show', $record->slug))
                    ->openUrlInNewTab(),

                EditAction::make()
                    ->label('Ubah'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
