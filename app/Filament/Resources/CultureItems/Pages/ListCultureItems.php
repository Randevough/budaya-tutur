<?php

namespace App\Filament\Resources\CultureItems\Pages;

use App\Filament\Resources\CultureItems\CultureItemResource;
use App\Models\CultureItem;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;

class ListCultureItems extends ListRecords
{
    protected static string $resource = CultureItemResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public function getSubheading(): ?string
    {
        return 'Kelola dan kurasi seluruh dokumentasi tuturan lisan nusantara.';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Catat Tuturan Baru')
                ->icon(Heroicon::OutlinedPlus),
        ];
    }

    public function getTabsContentComponent(): Component
    {
        return parent::getTabsContentComponent()
            ->extraAttributes(['class' => 'bt-table-tabs']);
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(CultureItem::count()),
            'published' => Tab::make('Terbit')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_published', true))
                ->badge(CultureItem::where('is_published', true)->count())
                ->badgeColor('gray'),
            'draft' => Tab::make('Draf')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_published', false))
                ->badge(CultureItem::where('is_published', false)->count())
                ->badgeColor('gray'),
        ];
    }
}
