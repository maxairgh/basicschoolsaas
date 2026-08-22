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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique();
            $table->string('school_name')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('tag_line')->nullable();
            $table->string('postal_address')->nullable(); 
            $table->string('location')->nullable(); 
            $table->string('digital_address')->nullable(); 
            $table->string('schoo_type')->nullable(); 
            $table->string('region'); 
            $table->string('head_signature')->nullable();
            $table->string('school_badge')->nullable();
            $table->string('school_type')->nullable();
            $table->string('head_name')->nullable(); 
            $table->string('head_title')->nullable(); 
            $table->string('id_prefix')->nullable(); 
            $table->string('status')->nullable(); 
            $table->string('service_name')->nullable(); 
            $table->text('admission_letter')->nullable(); 
            $table->text('settings')->nullable(); 
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
