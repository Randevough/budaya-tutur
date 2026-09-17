<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CultureItems\CultureItemResource;
use App\Models\CultureItem;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCultureItemsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Arsip Tuturan Terakhir';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(CultureItem::query()->latest()->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Budaya Tutur')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('regency.name')
                    ->label('Kabupaten / Kota')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('is_published')
                    ->label('Status')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Terbit' : 'Draf')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),

                TextColumn::make('created_at')
                    ->label('Waktu Ditambahkan')
                    ->dateTime('d M Y, H:i')
                    ->color('gray'),
            ])
            ->recordActions([
                Action::make('preview')
                    ->label('Lihat di Web')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->color('gray')
                    ->url(fn (CultureItem $record): string => route('arsip.show', $record->slug))
                    ->openUrlInNewTab(),

                EditAction::make()
                    ->label('Kelola')
                    ->url(fn (CultureItem $record): string => CultureItemResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
