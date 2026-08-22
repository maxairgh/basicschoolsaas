<?php

namespace App\Filament\Admin\Resources\SchoolApplications\Schemas;

use App\Enums\SchoolApplicationStatus;
use App\Models\District;
use App\Models\Region;
use App\Models\SchoolApplication;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

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
        ->hidden(fn (Get $get) => $get('status') == 'pending')
        ->color('danger')
        ->icon('heroicon-o-check-circle')
        ->schema([
                    Select::make('new_status')
                    ->options(SchoolApplicationStatus::class)
                    ->required(),
                     Textarea::make('admin_notes'),
    ])
        ->action(function (array $data, SchoolApplication $record){
             
            if ($data['new_status'] === SchoolApplicationStatus::APPROVED) {
                $record->approve(Auth()->user(), $data['admin_notes']); 
                Notification::make()
                ->title('Application Approved')
                ->body('The school application has been approved successfully.')
                ->success()
                ->send(); 
                //send email to the contact persona

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
                    ->default('pending')
                    ->disabled()
                    ->required(),
                
              TextInput::make('reviewer.full_name')
                ->label('Reviewed By')
                ->disabled(),
              DateTimePicker::make('reviewed_at')
                    ->readOnly(),
              Textarea::make('admin_notes')
                    ->readOnly()
                    ->columnSpanFull(),
        ]),
            ]);
    }

    function createSchoolAndAdminUser(SchoolApplication $application): void
    {

    DB::transaction(function () use ($application) {
        // Create the school record
        $school = School::create([
            'name' => $application->school_name,
            'type' => $application->school_type,
            'location' => $application->location,
            'region_id' => $application->region_id,
            'district_id' => $application->district_id,
            'contact_name' => $application->contact_name,
            'email' => $application->email,
            'phone' => $application->phone,
            'student_count' => $application->student_count,
            'teacher_count' => $application->teacher_count,
        ]);

        // Create the admin user for the school
        User::create([
            'school_id' => $school->id,
            'user_type' => 'admin',
            'first_name' => $application->contact_name, // Assuming contact name is the first name
            'email' => $application->email,
            'phone' => $application->phone,
            'password' => bcrypt(Str::random(12)), // Generate a random password
        ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // rethrow or handle/log as appropriate
            throw $e;
        }
    }
}
