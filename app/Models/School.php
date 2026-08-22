<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class School extends Model
{
    protected $fillable = [
        'serial',
        'school_name',
        'mobile_number',
        'email_address',
        'tag_line',
        'postal_address', 
        'location', 
        'digital_address', 
        'schoo_type', 
        'region', 
        'head_signature',
        'school_badge',
        'school_type',
        'head_name', 
        'head_title', 
        'id_prefix', 
        'status', 
        'service_name', 
        'admission_letter', 
        'settings'
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

    protected function users():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function learners():HasMany
    {
       // return $this->hasMany(Learner::class);
    }
    
}
