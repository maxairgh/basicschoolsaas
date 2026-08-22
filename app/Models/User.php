<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserType;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasRoles, SoftDeletes;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

      /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Multi Tenancy
        |--------------------------------------------------------------------------
        */
        'school_id',


        /*
        |--------------------------------------------------------------------------
        | Account Type
        |--------------------------------------------------------------------------
        */
        'user_type',


        /*
        |--------------------------------------------------------------------------
        | Identity
        |--------------------------------------------------------------------------
        */
        'employee_no',

        'first_name',

        'middle_name',

        'last_name',


        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */
        'email',

        'phone',

        'password',


        /*
        |--------------------------------------------------------------------------
        | Account Management
        |--------------------------------------------------------------------------
        */
        'avatar',

        'profile_completed',

        'must_change_password',

        'is_active',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [

        'password',

        'remember_token',

    ];


    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Authentication
            |--------------------------------------------------------------------------
            */
            'email_verified_at' => 'datetime',

            'phone_verified_at' => 'datetime',

            'password' => 'hashed',


            /*
            |--------------------------------------------------------------------------
            | Account Status
            |--------------------------------------------------------------------------
            */
            'profile_completed' => 'boolean',

            'must_change_password' => 'boolean',

            'is_active' => 'boolean',


            /*
            |--------------------------------------------------------------------------
            | Enum
            |--------------------------------------------------------------------------
            */
            'user_type' => UserType::class,

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    /**
     * User belongs to school
     *
     * System users will have null school_id
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }


    /**
     * User profile
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }


    /**
     * Login history
     */
    public function loginHistories()
    {
        return $this->hasMany(LoginHistory::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */


    public function getFullNameAttribute(): string
    {
        return collect([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
        ])
        ->filter()
        ->implode(' ');
    }


    /*
    |--------------------------------------------------------------------------
    | User Type Helpers
    |--------------------------------------------------------------------------
    */


    public function isSystemUser(): bool
    {
        return $this->user_type === UserType::SYSTEM;
    }


    public function isSchoolUser(): bool
    {
        return $this->user_type === UserType::SCHOOL;
    }


    public function isParent(): bool
    {
        return $this->user_type === UserType::PARENT;
    }


    /**
     * Check if user completed profile
     */
    public function hasCompletedProfile(): bool
    {
        return $this->profile_completed;
    }

    public function canAccessPanel(Panel $panel): bool
    {
     
       return match ($panel->getId()) {

        'admin' => $this->isSystemUser() && $this->is_active,

        'school' => $this->isSchoolUser() && $this->is_active,

        'parent' => $this->isParent() && $this->is_active,

        default => false,
    };
    }

     //  public function getFilamentAvatarUrl(): ?string
    //{
    //    return $this->avatar_url;
   // }

       public function getFilamentName(): string
    {
        return "{$this->getFullNameAttribute()}";
    }
    
}
