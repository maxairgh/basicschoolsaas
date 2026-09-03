<?php

namespace App\Services;

use App\Models\School;
use App\Models\SchoolApplication;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolApplicationApprovalService
{
    /**
     * Approve a school application and create
     * the school and its administrator.
     */
    public function approve( SchoolApplication $application, User $reviewer, ?string $note = null ): Array {
        
        return DB::transaction(function () use ($application, $reviewer, $note) {

            // 1. Approve the application
            $application->approve( $reviewer, $note );

            // 2. Create the school
            $school = School::create([
                'school_name' => $application->school_name,
                'school_type' => $application->school_type,
                'location' => $application->location,
                'region_id' => $application->region_id,
                'district_id' => $application->district_id,
            ]);

            // 3. Create the school administrator
           $admin = User::create([
                'school_id' => $school->id,
                'user_type' => 'school',
                'first_name' => $application->contact_person_firstname,
                'last_name' => $application->contact_person_lastname,
                'email' => $application->email,
                'phone' => $application->phone,
                'password' => Hash::make(Str::random(12)),
            ]);

            UserProfile::create([
                'user_id' => $admin->id,
            ]);

             return [
                'school' => $school,
                'admin' => $admin,
                ];
        });
    }
}