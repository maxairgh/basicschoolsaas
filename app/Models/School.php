<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUniqueStringIds;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
 {
    
use HasUniqueStringIds, SoftDeletes; 
       
    protected $fillable = [
        'serial',
        'school_name',
        'mobile_number',
        'email_address',
        'tag_line',
        'postal_address', 
        'location', 
        'digital_address', 
        'school_type', 
        'head_signature',
        'school_badge',
        'school_type',
        'head_name', 
        'head_title', 
        'id_prefix', 
        'status', 
        'service_name', 
        'admission_letter', 
        'settings',
        'region_id',
        'district_id',
    ];

       /**
 * Generate a new UUID for the model.
 */
public function newUniqueId(): string
{
    return (string) Uuid::uuid4();
}
 
/**
 * Get the columns that should receive a unique identifier.
 *
 * @return array<int, string>
 */
    public function uniqueIds(): array
    {
        return ['serial'];
    }

/**
     * Determine if the given unique ID is valid.
     */
    protected function isValidUniqueId(mixed $value): bool
    {
        return is_string($value) && Uuid::isValid($value);
    }

    protected function users():HasMany
    {
          return $this->hasMany(User::class);
    }

    public function learners():HasMany
    {
       // return $this->hasMany(Learner::class);
    }

    public function groups():HasMany
    {
       return $this->hasMany(Group::class);
    }

    public function departments():HasMany
    {
       return $this->hasMany(Department::class);
    }

    public function academicyears():HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }
    
    protected function casts(): array
{
    return [
        'settings' => 'array',
    ];
}

                /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        
      //  static::addGlobalScope('schoolcode', function (Builder $builder) {
       //     $builder->where('school_id', Auth::user()->school_id);
       // });

        // static::creating(function (AcademicYear $academicyear) {
        //     $academicyear->school_id = Auth::user()->school_id;
        //     $academicyear->user_id = Auth::user()->id;
        // });

        // static::updating(function (AcademicYear $academicyear) {
        //     $academicyear->school_id = Auth::user()->school_id;
        //     $academicyear->user_id = Auth::user()->id;
        // });

    }
}
