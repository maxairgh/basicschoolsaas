<?php

namespace App\Filament\Admin\Resources\SchoolApplications\Schemas;

use App\Enums\SchoolApplicationStatus;
use App\Mail\SchoolSignupApprovalEmail;
use App\Models\District;
use App\Models\Region;
use App\Models\School;
use App\Models\SchoolApplication;
use App\Models\User;
use App\Services\SchoolApplicationApprovalService;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;
use RuntimeException;

class SchoolApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
         ->columns(1)
            ->components([

    Section::make('School Information')
    ->description('Provide the school information for the application')
     ->columns(3)
    ->schema([

                TextInput::make('school_name')
                    ->required(),
                TextInput::make('school_type')
                    ->required()
                    ->default('private'),
                TextInput::make('location'),
                    Select::make('region_id')
                        ->label('Region')
                        ->options(fn () => Region::orderBy('region_name')->pluck('region_name', 'id'))
                        ->searchable()
                        ->live()
                        ->required()
                        ->afterStateUpdated(fn ($set) => $set('district_id', null)),

                    Select::make('district_id')
                        ->label('District')
                        ->options(function (Get $get) {
                            $regionId = $get('region_id');

                            if (! $regionId) {
                                return [];
                            }

                            return District::where('region_id', $regionId)
                                ->orderBy('district_name')
                                ->pluck('district_name', 'id');
                        })
                        ->searchable()
                        ->required()
                        ->disabled(fn (Get $get) => blank($get('region_id'))),
                TextInput::make('contact_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('student_count')
                    ->numeric(),
                TextInput::make('teacher_count')
                    ->numeric(),
                Textarea::make('message')
                    ->columnSpanFull(),

        ]),  
        
    Section::make('Admin Review')
    ->description('Provide the admin review information for the application')
    ->columns(3)
    ->afterHeader([
        Action::make('Take Action')
       //->hidden(fn (Get $get) => $get('status') !== 'PENDING')
        ->color('danger')
        ->icon('heroicon-o-check-circle')
        ->schema([
                    Select::make('new_status')
                    ->options(SchoolApplicationStatus::class)
                    ->required(),
                     Textarea::make('admin_notes'),
    ])
        ->action(function (Component $livewire, array $data, SchoolApplication $record){
            
         //check if the school has already been approved
               if ($record->status === SchoolApplicationStatus::APPROVED || $record->status === SchoolApplicationStatus::REJECTED) {
                              
               Notification::make()
                ->title('School Application Already Processed')
                ->body('The school application has already been processed.')  
                ->warning()   
                ->send();
                return;
                
                 }

            if ($data['new_status'] === SchoolApplicationStatus::APPROVED) {
              
             $feedback = app(SchoolApplicationApprovalService::class)->approve(
                    application: $record,
                    reviewer: auth()->user(),
                    note: $data['admin_notes'],
                );

            $livewire->refreshFormData([
                'status',
                'reviewed_by',
                'reviewed_at',
                'admin_notes',
            ]);

         $token = Password::broker()->createToken($feedback['admin']);
        
         $password_reset_link = Filament::getPanel('school')->getResetPasswordUrl($token, $feedback['admin']);  
                Notification::make()
                ->title('Application Approved')
                ->body('The school application has been approved successfully.')
                ->success()
                ->send(); 
                
                //send email to the contact personal
                Mail::to($feedback['admin']->email)->queue(new SchoolSignupApprovalEmail($feedback['school'], $password_reset_link));
                //create the school and admin user account for the school
            

            } elseif ($data['new_status'] === SchoolApplicationStatus::REJECTED) {
                 $record->reject(Auth()->user(), $data['admin_notes']);  
                 Notification::make()
                ->title('Application Rejected')
                ->body('The school application has been rejected.')
                ->danger()
                ->send();
            } else {    
             
                Notification::make()
                ->title('No Action Taken')
                ->body('The school application status remains unchanged.')
                ->warning()
                ->send();
            }
        })
        ->requiresConfirmation()
    ])
    ->schema([
                Select::make('status')
                    ->options(SchoolApplicationStatus::class)
                    ->disabled()
                    ->required(),
                
             Select::make('reviewer')
    ->label('Reviewed By')
    ->relationship('reviewer', 'first_name')
    ->getOptionLabelFromRecordUsing(
        fn ($record) => $record->full_name
    )
    ->disabled()
    ->required(),    
              

              DateTimePicker::make('reviewed_at')
                    ->disabled(),
              Textarea::make('admin_notes')
                    ->disabled()
                    ->columnSpanFull(),
        ]),
            ]);
    }

    public function approveSchool(array $data, SchoolApplication $record): void
{
   

    $this->notify(
        'success',
        "School {$school->school_name} has been approved successfully."
    );
}
    
}
