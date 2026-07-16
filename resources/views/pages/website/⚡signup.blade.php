<?php

use Livewire\Component;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Concerns\RestrictsFileUploadsToSchemaComponents;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Contracts\View\View;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use App\Enums\GhanaRegion;
use App\Enums\GhanaDistrict; 
use Filament\Forms\Components\Textarea;
use Filament\Actions\Action;
use Illuminate\Support\HtmlString;

new class extends Component implements HasSchemas
{
    use InteractsWithSchemas;
   //use RestrictsFileUploadsToSchemaComponents;

     public ?array $data = [];
    
    public function mount(): void
    {
        $this->form->fill();
    }
    
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                      Wizard::make([


                    /*
                    |--------------------------------------------------------------------------
                    | Step 1: School Information
                    |--------------------------------------------------------------------------
                    */

                    Wizard\Step::make('School Information')
                        ->icon('heroicon-o-building-office')
                        ->schema([


                            TextInput::make('school_name')

                                ->label('School Name')

                                ->placeholder('Example: Bright Future Academy')

                                ->required()

                                ->maxLength(255),



                            Select::make('school_type')

                                ->label('School Type')

                                ->options([

                                    'private' => 'Private School',

                                    'public' => 'Public School',
                                ])

                                ->default('private')

                                ->required(),



                            Select::make('region')

                                ->label('Region')

                                ->options(
                                    GhanaRegion::options()
                                )

                                ->searchable()

                                ->required(),



                            Select::make('district')

                                ->label('District')

                                ->options(
                                    GhanaDistrict::options()
                                )

                                ->searchable()

                                ->required(),



                            TextInput::make('location')

                                ->label('School Location')

                                ->placeholder('Town / Community')

                                ->required(),


                        ]),



                    /*
                    |--------------------------------------------------------------------------
                    | Step 2: Contact Person
                    |--------------------------------------------------------------------------
                    */

                    Wizard\Step::make('Contact Information')

                        ->icon('heroicon-o-user')

                        ->schema([


                            TextInput::make('contact_name')

                                ->label('Contact Person Name')

                                ->placeholder('Headteacher / Proprietor')

                                ->required(),



                            TextInput::make('email')

                                ->label('Email Address')

                                ->email()

                                ->required(),



                            TextInput::make('phone')

                                ->label('Phone Number')

                                ->tel()

                                ->placeholder('055xxxxxxx')

                                ->required(),

                        ]),



                    /*
                    |--------------------------------------------------------------------------
                    | Step 3: School Details
                    |--------------------------------------------------------------------------
                    */

                    Wizard\Step::make('School Details')

                        ->icon('heroicon-o-chart-bar')

                        ->schema([


                            TextInput::make('student_count')

                                ->label('Number of Students')

                                ->numeric()

                                ->placeholder('Example: 300')

                                ->required(),



                            TextInput::make('teacher_count')

                                ->label('Number of Teachers')

                                ->numeric()

                                ->placeholder('Example: 20')

                                ->required(),



                            Textarea::make('message')

                                ->label('Additional Information')

                                ->placeholder(
                                    'Tell us about your school or what you need help with'
                                )

                                ->rows(4)

                                ->columnSpanFull(),


                        ]),


                ])

                  ->submitAction(new HtmlString(
                  '<button
                            type="submit"
                            style="background-color: #2563eb; color: white; border-radius: 0.75rem; padding: 1rem 2.5rem; font-size: 1.125rem; font-weight: 600; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); transition: background-color 0.3s ease, transform 0.3s ease;"
                            class="inline-flex items-center rounded-xl bg-blue-600 px-10 py-4 text-lg font-semibold text-white shadow-lg transition hover:bg-blue-700 hover:scale-105">

                            Submit Application

                        </button>'
                  )),


            ])

            ->statePath('data');
            
    }
    
    public function create(): void
    {
        dd($this->form->getState());
    }

};
?>

<div>

    <!-- ==========================================================
        Navigation
    ========================================================== -->
    <livewire:website.nav />


    <!-- ==========================================================
        School Registration Hero
    ========================================================== -->
    <section class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 py-20 ">

        <div class="mx-auto max-w-5xl px-30 text-center text-white mt-3">

            <span class="inline-flex rounded-full bg-white/20 px-5 py-2 text-sm font-semibold">
                Join Our School Management Platform
            </span>


            <h1 class="mt-6 text-4xl font-extrabold md:text-5xl">

                Register Your School Today

            </h1>


            <p class="mx-auto mt-5 max-w-3xl text-lg text-blue-100">

                Digitize your school administration, manage learners,
                simplify assessments, connect parents and improve your
                school's efficiency with our cloud-based platform.

            </p>

        </div>

    </section>



    <!-- ==========================================================
        Application Form
    ========================================================== -->
    <section class="bg-slate-50 py-20">

        <div class="mx-auto max-w-4xl px-6">


            <div class="rounded-3xl bg-white p-8 shadow-xl md:p-12">


                <!-- Form Header -->

                <div class="mb-10 text-center">

                    <h2 class="text-3xl font-bold text-slate-900">

                        School Application Form

                    </h2>


                    <p class="mt-3 text-slate-600">

                        Submit your school details and our team will
                        contact you to complete your setup.

                    </p>

                </div>

                <form wire:submit="create" class="space-y-8">

                    {{ $this->form }}

            <x-filament-actions::modals />
  

                </form>


            </div>


        </div>

    </section>


    <!-- ==========================================================
        Trust Section
    ========================================================== -->

    <section class="bg-white py-16">

        <div class="mx-auto grid max-w-6xl gap-8 px-6 md:grid-cols-3">


            <div class="rounded-2xl bg-blue-50 p-6 text-center">

                <div class="text-3xl">
                    🔒
                </div>

                <h3 class="mt-4 font-bold text-slate-900">
                    Secure Platform
                </h3>

                <p class="mt-2 text-sm text-slate-600">
                    Your school information is protected using secure
                    cloud technology.
                </p>

            </div>



            <div class="rounded-2xl bg-blue-50 p-6 text-center">

                <div class="text-3xl">
                    🎓
                </div>

                <h3 class="mt-4 font-bold text-slate-900">
                    Built For Schools
                </h3>

                <p class="mt-2 text-sm text-slate-600">
                    Designed specifically for Preschool, KG, Primary
                    and JHS institutions.
                </p>

            </div>



            <div class="rounded-2xl bg-blue-50 p-6 text-center">

                <div class="text-3xl">
                    🚀
                </div>

                <h3 class="mt-4 font-bold text-slate-900">
                    Quick Setup
                </h3>

                <p class="mt-2 text-sm text-slate-600">
                    Start managing your school after approval and setup.
                </p>

            </div>

        </div>

    </section>

    <!-- ==========================================================
        Footer
    ========================================================== -->
    <livewire:website.footer />

</div>