<?php

use App\Enums\SchoolApplicationStatus;
use App\Models\School;
use App\Models\SchoolApplication;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\SchoolApplicationApprovalService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('converts an application and creates one school owner profile', function () {
    $regionId = DB::table('regions')->insertGetId([
        'region_name' => 'Ashanti',
        'region_capital' => 'Kumasi',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $districtId = DB::table('districts')->insertGetId([
        'region_id' => $regionId,
        'district_name' => 'Kumasi Metropolitan',
        'district_capital' => 'Kumasi',
        'district_category' => 'Metropolitan',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $reviewer = User::create([
        'user_type' => 'admin',
        'first_name' => 'System',
        'last_name' => 'Admin',
        'email' => 'reviewer@example.com',
        'password' => 'password',
    ]);

    $application = SchoolApplication::create([
        'school_name' => 'Bright Future Academy',
        'school_type' => 'private',
        'location' => 'Kumasi',
        'region_id' => $regionId,
        'district_id' => $districtId,
        'contact_person_firstname' => 'Ama',
        'contact_person_lastname' => 'Mensah',
        'email' => 'owner@example.com',
        'phone' => '0551234567',
        'status' => SchoolApplicationStatus::PENDING,
    ]);

    $result = app(SchoolApplicationApprovalService::class)->approve(
        application: $application,
        reviewer: $reviewer,
        note: 'Application verified.',
    );

    expect($application->fresh()->status)->toBe(SchoolApplicationStatus::CONVERTED)
        ->and($result['school'])->toBeInstanceOf(School::class)
        ->and($result['admin']->profile)->toBeInstanceOf(UserProfile::class)
        ->and(UserProfile::where('user_id', $result['admin']->id)->count())->toBe(1);
});