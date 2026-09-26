<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class SchoolSettings extends Page implements HasSchemas
{
     use InteractsWithSchemas;
     
    protected string $view = 'filament.pages.school-settings';

    protected static ?string $title = 'School Settings';
    protected static ?string $navigationLabel = 'School Settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 2;

    public ?array $data = []; 

        public static function canAccess(): bool
    {
        return auth()->user()->can('School.View');
    }

    public function mount(): void
    {
        $school = auth()->user()->school;

        abort_unless($school, 404);

        $data = [
            'admission_letter' => $school->admission_letter,
            'settings'         => $school->settings,
        ];
         $this->form->fill($data);
    }

    public function form(Schema $schema): Schema
    {  
        return $schema
        ->components([

                /*
            |--------------------------------------------------------------------------
            | Admission Letter
            |--------------------------------------------------------------------------
            */

            Section::make('Admission Letter')
                ->description('Configure the admission letter template.')
                ->icon('heroicon-o-document-text')
                ->schema([

                    Textarea::make('admission_letter')
                        ->label('Admission Letter Template')
                        ->rows(12)
                        ->placeholder('Enter admission letter template...')
                        ->columnSpanFull(),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            Section::make('System Settings')
                ->description('Additional school configuration.')
                ->icon('heroicon-o-cog-6-tooth')
                ->schema([
            KeyValue::make('settings')
                        ->label('Meta Information')
                        ->keyLabel('Parameter  Name')
                        ->valueLabel('Value')
                        
                        ->columnSpanFull(),
                ]),
        ])->statePath('data');
    }

    public function submit(){
        //get data from form
        $formData = $this->form->getState();
        //get school 
          $school = auth()->user()->school;
          //update school details
          $school->update($formData);
          //notify the user
         Notification::make()
        ->title('School settings updated successfully')
        ->success()
        ->send();

    }
}
