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
    Schema::create('login_histories', function (Blueprint $table) {
    $table->id();

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    $table->string('guard')->nullable();
    $table->string('authentication_method')->nullable();
    $table->string('login_type')->nullable();
    $table->boolean('successful')->default(false);
    $table->string('failure_reason')->nullable();

    /*
    |--------------------------------------------------------------------------
    | Login / Logout
    |--------------------------------------------------------------------------
    */

    $table->timestamp('login_at')
        ->nullable();
    $table->timestamp('logout_at')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Session
    |--------------------------------------------------------------------------
    */

    $table->string('session_id')
        ->nullable()
        ->index();

    /*
    |--------------------------------------------------------------------------
    | Network
    |--------------------------------------------------------------------------
    */

    $table->string('ip_address', 45)
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Device
    |--------------------------------------------------------------------------
    */

    $table->string('device_type')
        ->nullable();
    $table->string('platform')
        ->nullable();
    $table->string('browser')
        ->nullable();
    $table->text('user_agent')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Location
    |--------------------------------------------------------------------------
    */

    $table->string('country_code', 2)
        ->nullable();
    $table->string('country')
        ->nullable();
    $table->string('city')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | API / Mobile
    |--------------------------------------------------------------------------
    */

    $table->string('application')
        ->nullable();
    $table->string('token_id')
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | Additional Context
    |--------------------------------------------------------------------------
    */

    $table->json('metadata')
        ->nullable();

    $table->timestamps();

    /*
    |--------------------------------------------------------------------------
    | Indexes
    |--------------------------------------------------------------------------
    */

    $table->index([
        'user_id',
        'login_at',
    ]);

    $table->index([
        'successful',
        'login_at',
    ]);

    $table->index([
        'ip_address',
        'login_at',
    ]);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_histories');
    }
};
