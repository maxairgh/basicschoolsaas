<?php

namespace App\Filament\Admin\Resources\Schools\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('serial')
                    ->required(),
                TextInput::make('school_name')
                    ->required(),
                TextInput::make('mobile_number'),
                TextInput::make('email_address')
                    ->email(),
                TextInput::make('tag_line'),
                TextInput::make('postal_address'),
                TextInput::make('location'),
                TextInput::make('digital_address'),
                TextInput::make('school_type'),
                TextInput::make('head_signature'),
                TextInput::make('school_badge'),
                TextInput::make('head_name'),
                TextInput::make('head_title'),
                TextInput::make('id_prefix'),
                TextInput::make('status'),
                TextInput::make('service_name'),
                Textarea::make('admission_letter')
                    ->columnSpanFull(),
                Textarea::make('settings')
                    ->columnSpanFull(),
                TextInput::make('region_id')
                    ->numeric(),
                TextInput::make('district_id')
                    ->numeric(),
            ]);
    }
}
