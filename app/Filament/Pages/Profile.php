<?php

namespace App\Filament\Pages;

use App\Enums\UserType;
use App\Models\Region;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon; 
use UnitEnum;

class Profile extends Page implements HasSchemas
{
     use InteractsWithSchemas;
        protected string $view = 'filament.pages.profile';

     protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 2;
         public static function canAccess(): bool
    {
        
        return auth()->user()->can('Profile.edit');
    }

           public ?array $data = []; 
           public User $user;

public function mount(): void
{
    $this->user = User::with(['profile', 'roles'])->find(auth()->id());
    abort_unless($this->user, 404);
    //dd($this->user->toArray());
    $this->form->fill($this->user->toArray());

}


public function form(Schema $schema): Schema
{
    return $schema
        ->statePath('data')
        ->components([
        Section::make('User Details')
                ->columns(3)
                ->description('This section contains the details of the user.')
                ->schema([

                Select::make('user_type')
                    ->options([
                       // UserType::SYSTEM->value => UserType::SYSTEM->label(),
                        UserType::SCHOOL->value => UserType::SCHOOL->label(),
                        UserType::PARENT->value => UserType::PARENT->label(),
                    ])
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
          FileUpload::make('avatar')
           ->maxSize(600)
           ->image()
           ->disk('public')
           ->directory('useravatar')
           ->avatar(),
           //Toggle::make('is_active')
            //        ->required(),
            ]),
            //TextEntry::make('is_active'),
             Section::make('User Profile')
                ->columns(3)
                ->description('This section contains the profile of the user.')
                ->schema([
                    
                Select::make('profile.gender')
                       ->options([
                        'Male' => 'Male',
                        'Female' => 'Female'
                       ])
                       ,
                 DatePicker::make('profile.date_of_birth'),
                 TextInput::make('profile.address'),
             
                Select::make('profile.region')
                        ->label('Region')
                        ->options(fn () => Region::orderBy('region_name')->pluck('region_name', 'id'))
                        ->searchable()
                       // ->live()
                        ->required(),
                       // ->afterStateUpdated(fn ($set) => $set('district_id', null)),
       TextInput::make('profile.city'),
       TextInput::make('profile.emergency_contact_name'),
       TextInput::make('profile.emergency_contact_phone'),
       Textarea::make('profile.bio')->columnSpan(2),
                    ]),
             Section::make('User Permissions')
                ->columns(3)
                ->description('This section contains the permissions for the user.')
                ->schema([
                   
                TextEntry::make('roles')
                ->label('Roles')
                ->state(fn () => $this->user->roles->pluck('name'))
                ->badge(),
                
                    ])

        ]);

}


public function submit(): void
{
    $data = $this->form->getState();

    // Update user details
    $this->user->update([
        'user_type'   => $data['user_type'] ?? null,
        'employee_no' => $data['employee_no'] ?? null,
        'first_name'  => $data['first_name'] ?? null,
        'middle_name' => $data['middle_name'] ?? null,
        'last_name'   => $data['last_name'] ?? null,
        'email'       => $data['email'] ?? null,
        'phone'       => $data['phone'] ?? null,
        'avatar'      => $data['avatar'] ?? null,
    ]);

    // Update user profile
    $this->user->profile()->updateOrCreate(
        ['user_id' => $this->user->id],
        [
            'gender'                  => $data['profile']['gender'] ?? null,
            'date_of_birth'           => $data['profile']['date_of_birth'] ?? null,
            'address'                 => $data['profile']['address'] ?? null,
            'region'                  => $data['profile']['region'] ?? null,
            'city'                    => $data['profile']['city'] ?? null,
            'emergency_contact_name'  => $data['profile']['emergency_contact_name'] ?? null,
            'emergency_contact_phone' => $data['profile']['emergency_contact_phone'] ?? null,
            'bio'                     => $data['profile']['bio'] ?? null,
        ]
    );

    // Refresh the user relationship
    $this->user->refresh();
    $this->user->load(['profile', 'roles']);

    // Refill form with updated data
    $this->form->fill($this->user->toArray());

    Notification::make()
        ->title('Profile updated successfully')
        ->success()
        ->send();
}

}
