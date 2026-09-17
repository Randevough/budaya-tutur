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
            ->searchPlaceholder('Cari tuturan...')
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
                    ->html()
                    ->formatStateUsing(fn (bool $state): string => $state
                        ? '<span class="bt-status-pill published"><span class="bt-dot"></span>Terbit</span>'
                        : '<span class="bt-status-pill draft"><span class="bt-dot"></span>Draf</span>'
                    ),

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
                    ->label('Edit')
                    ->url(fn (CultureItem $record): string => CultureItemResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
