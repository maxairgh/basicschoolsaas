<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use App\Enums\UserType;
use App\Models\Region;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
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

                  Select::make('school_id')
                  ->label('School')
                  ->relationship('school', 'school_name')
                  ->preload()
                  ->searchable(),
                Select::make('user_type')
                    ->options(UserType::class)
                    ->required(),
                TextInput::make('employee_no'),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name'),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                 TextInput::make('password')
                    ->password()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create'),
               // TextInput::make('avatar'),
                 FileUpload::make('avatar')
           ->maxSize(600)
           ->image()
           ->disk('public')
           ->directory('useravatar')
           ->avatar(),
                DateTimePicker::make('email_verified_at'),
                DateTimePicker::make('phone_verified_at'),
                Toggle::make('profile_completed')
                    ->required(),
                Toggle::make('must_change_password')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]),
             Section::make('User Profile')
                ->columns(3)
                ->relationship('profile')
                ->description('This section contains the profile of the user.')
                ->schema([
                    
                Select::make('gender')
                       ->options([
                        'Male' => 'Male',
                        'Female' => 'Female'
                       ])
                       ,
                 DatePicker::make('date_of_birth'),
                 TextInput::make('address'),
             
                Select::make('region')
                        ->label('Region')
                        ->options(fn () => Region::orderBy('region_name')->pluck('region_name', 'id'))
                        ->searchable()
                       // ->live()
                        ->required(),
                       // ->afterStateUpdated(fn ($set) => $set('district_id', null)),
       TextInput::make('city'),
       TextInput::make('emergency_contact_name'),
       TextInput::make('emergency_contact_phone'),
       Textarea::make('bio')->columnSpan(2),

          

                    ]),
             Section::make('User Details')
                ->columns(3)
                ->description('This section contains the details of the user.')
                ->schema([
                    
                Select::make('roles')
                       ->multiple()
                       ->searchable()
                        ->preload()
                        ->relationship('roles', 'name'),

          

                    ])

            ]);
    }
}
