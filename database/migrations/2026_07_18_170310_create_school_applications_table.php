<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_applications', function (Blueprint $table) {
            $table->id();


            /*
            |--------------------------------------------------------------------------
            | School Information
            |--------------------------------------------------------------------------
            */

            $table->string('school_name')->unique();;

            $table->string('school_type')
                ->default('private');

            $table->string('location')
                ->nullable();

            $table->foreignId('region_id')
                ->constrained('regions')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('district_id')
                ->constrained('districts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Contact Person
            |--------------------------------------------------------------------------
            */

            $table->string('contact_name');

            $table->string('email')->unique()
                ->index();

            $table->string('phone')->unique();


            /*
            |--------------------------------------------------------------------------
            | School Size
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('student_count')
                ->nullable();

            $table->unsignedInteger('teacher_count')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Application Details
            |--------------------------------------------------------------------------
            */

            $table->text('message')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Application Workflow
            |--------------------------------------------------------------------------
            */

            // Managed using PHP Enum
            $table->string('status')
                ->default('pending');


            /*
            |--------------------------------------------------------------------------
            | Review Information
            |--------------------------------------------------------------------------
            */

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            $table->timestamp('reviewed_at')
                ->nullable();


            $table->text('admin_notes')
                ->nullable();


            $table->timestamps();

            $table->softDeletes();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('school_applications');
    }

};
