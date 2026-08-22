<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
 protected $fillable = [

        'user_id',

        /*
        |--------------------------------------------------------------------------
        | Personal Information
        |--------------------------------------------------------------------------
        */
        'gender',

        'date_of_birth',

        'nationality',

        'national_id',


        /*
        |--------------------------------------------------------------------------
        | Address
        |--------------------------------------------------------------------------
        */
        'address',

        'city',

        'region',


        /*
        |--------------------------------------------------------------------------
        | Emergency Contact
        |--------------------------------------------------------------------------
        */
        'emergency_contact_name',

        'emergency_contact_phone',


        /*
        |--------------------------------------------------------------------------
        | Additional Information
        |--------------------------------------------------------------------------
        */
        'bio',

    ];



    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
