<?php

namespace App\Filament\Pages;

use App\Models\District;
use App\Models\Region;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class School extends Page implements HasSchemas
{
    use InteractsWithSchemas;
    protected string $view = 'filament.pages.school';//

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
     protected static string | UnitEnum | null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'School Details';

    public static function canAccess(): bool
    {
        
        return auth()->user()->can('School.View');
    }

       public ?array $data = []; 

public function mount(): void
{
    $school = auth()->user()->school;

    abort_unless($school, 404);

    $data = [
        'serial'          => $school->serial,
        'school_name'     => $school->school_name,
        'mobile_number'   => $school->mobile_number,
        'email_address'   => $school->email_address,
        'tag_line'        => $school->tag_line,
        'postal_address'  => $school->postal_address,
        'location'        => $school->location,
        'digital_address' => $school->digital_address,
        'school_type'     => $school->school_type,
        'head_signature'  => $school->head_signature,
        'school_badge'    => $school->school_badge,
        'head_name'       => $school->head_name,
        'head_title'      => $school->head_title,
        'id_prefix'       => $school->id_prefix,
        'status'          => $school->status,
        'service_name'    => $school->service_name,
        'admission_letter'=> $school->admission_letter,
        'settings'        => $school->settings,
        'region_id'       => $school->region_id,
        'district_id'     => $school->district_id,
    ];
    $this->form->fill($data);

   //dd($data);
}


public function form(Schema $schema): Schema
{
    return $schema
        ->components([

            /*
            |--------------------------------------------------------------------------
            | School Information
            |--------------------------------------------------------------------------
            */

            Section::make('School Information')
                ->description('Basic information about the school.')
                ->icon('heroicon-o-building-office-2')
                ->columns(2)
                ->schema([

                    TextInput::make('serial')
                        ->label('School Serial')
                        ->disabled()
                        ->dehydrated()
                        ->required(),

                    TextInput::make('school_name')
                        ->label('School Name')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    TextInput::make('tag_line')
                        ->label('Tag Line')
                        ->placeholder('Enter school tag line')
                        ->maxLength(255),

                    Select::make('school_type')
                        ->label('School Type')
                        ->options([
                            'public' => 'Public',
                            'private' => 'Private',
                           // 'government' => 'Government',
                          //  'international' => 'International',
                        ])
                        ->searchable()
                        ->native(false),

                    TextInput::make('service_name')
                        ->label('Service Name')
                        ->placeholder('e.g. RexOnline')
                        ->maxLength(255),

                    TextInput::make('id_prefix')
                        ->label('Learner ID Prefix')
                        ->placeholder('e.g. KTI')
                        ->maxLength(20)
                        ->helperText('Prefix used when generating learner/student IDs.'),

                   Toggle::make('status')
                        ->label('Active')
                        ->default(true)
                        ->inline(false),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */

            Section::make('Contact Information')
                ->description('School contact and address information.')
                ->icon('heroicon-o-phone')
                ->columns(2)
                ->schema([

                    TextInput::make('mobile_number')
                        ->label('Mobile Number')
                        ->tel()
                        ->maxLength(30),

                    TextInput::make('email_address')
                        ->label('Email Address')
                        ->email()
                        ->maxLength(255),

                    TextInput::make('postal_address')
                        ->label('Postal Address')
                        ->maxLength(255),

                    TextInput::make('location')
                        ->label('Location')
                        ->maxLength(255),

                    TextInput::make('digital_address')
                        ->label('Digital Address')
                        ->placeholder('e.g. ER-123-4567')
                        ->maxLength(255),

                    Select::make('region_id')
                        ->label('Region')
                        ->options(
                            Region::query()
                                ->orderBy('region_name')
                                ->pluck('region_name', 'id')
                        )
                        ->searchable()
                        ->preload()
                        ->native(false)
                        ->live(),

                    Select::make('district_id')
                        ->label('District')
                        ->options(function (callable $get) {
                            $regionId = $get('region_id');

                            if (!$regionId) {
                                return [];
                            }

                            return District::query()
                                ->where('region_id', $regionId)
                                ->orderBy('district_name')
                                ->pluck('district_name', 'id');
                        })
                        ->searchable()
                        ->preload()
                        ->native(false)
                        ->disabled(fn (callable $get) => !$get('region_id'))
                        ->required(fn (callable $get) => filled($get('region_id'))),
                ]),

            /*
            |--------------------------------------------------------------------------
            | School Branding
            |--------------------------------------------------------------------------
            */

            Section::make('School Branding')
                ->description('Upload the school badge and head signature.')
                ->icon('heroicon-o-photo')
                ->columns(2)
                ->schema([

                    FileUpload::make('school_badge')
                        ->label('School Badge / Logo')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('schools/badges')
                        ->maxSize(2048)
                        ->columnSpan(1),

                    FileUpload::make('head_signature')
                        ->label('Head Signature')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('schools/signatures')
                        ->maxSize(2048)
                        ->columnSpan(1),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Head of School
            |--------------------------------------------------------------------------
            */

            Section::make('Head of School')
                ->description('Information about the head of the school.')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([

                    TextInput::make('head_name')
                        ->label('Head Name')
                        ->maxLength(255),

                    TextInput::make('head_title')
                        ->label('Head Title')
                        ->placeholder('e.g. Headmaster, Headmistress, Principal')
                        ->maxLength(255),
                ]),
  
             
        ])->statePath('data');
}


    public function submit(): void
    {
          $school = auth()->user()->school;

        $data = $this->form->getState();

        // Don't allow serial to be changed.
        unset($data['serial'], $data['status']);

        $school->update($data);

        Notification::make()
            ->title('School details updated successfully')
            ->success()
            ->send();
    }

}
