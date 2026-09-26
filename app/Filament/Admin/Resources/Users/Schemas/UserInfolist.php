<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(1)
            ->components([
               

Section::make('User Details')
->columns(3)
->description('This section contains the details of the user.')
  ->schema([
        // ...
   
                TextEntry::make('school_id')
                    ->label('School')
                    ->numeric()
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('user_type')
                    ->badge(),
                TextEntry::make('employee_no')
                    ->badge()
                ->placeholder('-'),
                TextEntry::make('first_name')
                    ->badge(),
                TextEntry::make('middle_name')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('last_name')
                    ,
                TextEntry::make('email')
                ->badge()
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->badge()
                    ->placeholder('-'),
                ImageEntry::make('avatar')
                   // ->badge()
                    ->placeholder('-'),
                TextEntry::make('email_verified_at')
                    ->dateTime()
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('phone_verified_at')
                    ->dateTime()
                    ->badge()
                    ->placeholder('-'),
                IconEntry::make('profile_completed')
                    ->boolean(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (User $record): bool => $record->trashed()),

         ]),

         Section::make('User Privileges')
->columns(3)
->description('This section contains the privileges of the user.')
  ->schema([
               
                TextEntry::make('roles.name')
                    ->label('Roles')
                    ->badge(),
                 
            
  ]),

            ]);
    }
}
