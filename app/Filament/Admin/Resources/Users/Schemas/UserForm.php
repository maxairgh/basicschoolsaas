<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use App\Enums\UserType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_id')
                    ->numeric(),
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
                    ->required(),
                TextInput::make('avatar'),
                DateTimePicker::make('email_verified_at'),
                DateTimePicker::make('phone_verified_at'),
                Toggle::make('profile_completed')
                    ->required(),
                Toggle::make('must_change_password')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
