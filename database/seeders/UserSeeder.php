<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
     * Run the database seeds.
     */
    
        /*
        |--------------------------------------------------------------------------
        | System Administrator
        |--------------------------------------------------------------------------
        */

        User::create([
            'school_id' => null,

            'user_type' => UserType::SYSTEM->value,

            'employee_no' => 'SYS001',

            'first_name' => 'System',

            'middle_name' => null,

            'last_name' => 'Administrator',

            'email' => 'admin@penonline.com',

            'phone' => null,

            'password' => Hash::make('password'),

            'avatar' => null,

            'profile_completed' => true,

            'must_change_password' => false,

            'is_active' => true,
        ]);


        /*
        |--------------------------------------------------------------------------
        | School Administrator Example
        |--------------------------------------------------------------------------
        */

        User::create([
            'school_id' => null, // Change to your school ID

            'user_type' => UserType::SCHOOL->value,

            'employee_no' => 'SCH001',

            'first_name' => 'School',

            'middle_name' => null,

            'last_name' => 'Administrator',

            'email' => 'schooladmin@penonline.com',

            'phone' => '0240000000',

            'password' => Hash::make('password'),

            'avatar' => null,

            'profile_completed' => true,

            'must_change_password' => true,

            'is_active' => true,
        ]);
    
    }
}
