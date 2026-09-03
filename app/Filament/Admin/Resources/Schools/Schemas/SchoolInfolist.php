<?php

namespace App\Filament\Admin\Resources\Schools\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SchoolInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('serial'),
                TextEntry::make('school_name'),
                TextEntry::make('mobile_number')
                    ->placeholder('-'),
                TextEntry::make('email_address')
                    ->placeholder('-'),
                TextEntry::make('tag_line')
                    ->placeholder('-'),
                TextEntry::make('postal_address')
                    ->placeholder('-'),
                TextEntry::make('location')
                    ->placeholder('-'),
                TextEntry::make('digital_address')
                    ->placeholder('-'),
                TextEntry::make('school_type')
                    ->placeholder('-'),
                TextEntry::make('head_signature')
                    ->placeholder('-'),
                TextEntry::make('school_badge')
                    ->placeholder('-'),
                TextEntry::make('head_name')
                    ->placeholder('-'),
                TextEntry::make('head_title')
                    ->placeholder('-'),
                TextEntry::make('id_prefix')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->placeholder('-'),
                TextEntry::make('service_name')
                    ->placeholder('-'),
                TextEntry::make('admission_letter')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('settings')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('region_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('district_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
