<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Support\Facades\Auth;

class AcademicYear extends Model
{
    protected $fillable = [
        'school_id',
        'user_id',
        'name',
        'status',
    ];

        public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**     
     * * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        
        static::addGlobalScope('schoolcode', function (Builder $builder) {
            $builder->where('school_id', Auth::user()->school_id);
        });

        static::creating(function (AcademicYear $academicyear) {
            $academicyear->school_id = Auth::user()->school_id;
            $academicyear->user_id = Auth::user()->id;
        });

        static::updating(function (AcademicYear $academicyear) {
            $academicyear->school_id = Auth::user()->school_id;
            $academicyear->user_id = Auth::user()->id;
        });

    }

}
