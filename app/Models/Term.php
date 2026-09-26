<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Term extends Model
{
   protected $fillable = [
    'school_id',
    'user_id',
    'name',
    'description',
    'status'
   ];

    protected $casts = [
        'status' => 'boolean',
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

        static::creating(function (Term $term) {
            $term->school_id = Auth::user()->school_id;
            $term->user_id = Auth::user()->id;
        });

        static::updating(function (Term $term) {
            $term->school_id = Auth::user()->school_id;
            $term->user_id = Auth::user()->id;
        });
    }
}
