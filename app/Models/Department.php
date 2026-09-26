<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    protected $fillable = [
        'school_id',
        'user_id',
        'name',
        'sequence',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        protected static function booted(): void
    {
        static::addGlobalScope('schoolcode', function ($builder) {
            $builder->where('school_id', Auth::user()->school_id);
        });

        static::creating(function (Department $department) {
            $department->school_id = Auth::user()->school_id;
            $department->user_id = Auth::user()->id;
        });

        static::updating(function (Department $department) {
            $department->school_id = Auth::user()->school_id;
            $department->user_id = Auth::user()->id;
        });
    }
}
