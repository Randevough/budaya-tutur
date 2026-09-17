<?php

namespace App\Filament\Resources\CultureItems\Tables;

use App\Filament\Resources\CultureItems\CultureItemResource;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CultureItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['regency.province']))
            ->searchPlaceholder('Cari tuturan...')
            ->columns([
                ImageColumn::make('cover_image_path')
                    ->label('Sampul')
                    ->defaultImageUrl(fn (CultureItem $record): ?string => $record->youtube_id ? "https://img.youtube.com/vi/{$record->youtube_id}/mqdefault.jpg" : null)
                    ->width(68)
                    ->height(38)
                    ->extraImgAttributes([
                        'class' => 'rounded-md object-cover border border-stone-200/90 shadow-2xs',
                    ]),

                TextColumn::make('title')
                    ->label('Judul Budaya Tutur')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (CultureItem $record): ?string => $record->excerpt ? Str::limit($record->excerpt, 50) : null)
                    ->url(fn (CultureItem $record): string => CultureItemResource::getUrl('edit', ['record' => $record])),

                TextColumn::make('regency.name')
                    ->label('Wilayah Asal')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(fn (CultureItem $record): ?string => $record->regency?->province?->name),

                TextColumn::make('youtube_id')
                    ->label('YouTube ID')
                    ->badge()
                    ->color('zinc')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('is_published')
                    ->label('Status')
                    ->html()
                    ->formatStateUsing(fn (bool $state): string => $state
                        ? '<span class="bt-status-pill published"><span class="bt-dot"></span>Terbit</span>'
                        : '<span class="bt-status-pill draft"><span class="bt-dot"></span>Draf</span>'
                    )
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
                EditAction::make()
                    ->label('Edit'),

                Action::make('preview')
                    ->label('Lihat di Web')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->color('gray')
                    ->url(fn (CultureItem $record): string => route('arsip.show', $record->slug))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
