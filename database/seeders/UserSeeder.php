<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Super Admin Role
        |--------------------------------------------------------------------------
        */

        $superAdminRole = Role::firstOrCreate(
            [
                'name' => 'HDS_Super_Admin',
                'guard_name' => 'web',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | System Administrator
        |--------------------------------------------------------------------------
        */

        $user = User::updateOrCreate(
            [
                'email' => 'admin@penonline.com',
            ],
            [
                'school_id' => null,

                'user_type' => UserType::SYSTEM->value,

                'employee_no' => 'SYS001',

                'first_name' => 'System',

                'middle_name' => null,

                'last_name' => 'Administrator',

                'phone' => null,

                'password' => Hash::make('password'),

                'avatar' => null,

                'profile_completed' => true,

                'must_change_password' => false,

                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Assign Super Admin Role
        |--------------------------------------------------------------------------
        */

        $user->syncRoles([
            $superAdminRole,
        ]);
    }
}