<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['default' => 1])
            ->components([
                ViewEntry::make('message_details')
                    ->hiddenLabel()
                    ->view('filament.infolists.contact-message-view')
                    ->columnSpanFull(),
            ]);
    }
}
