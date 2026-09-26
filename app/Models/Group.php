<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $fillable = [
        'school_id',
        'user_id',
        'name',
        'description',
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

        static::creating(function (Group $group) {
            $group->school_id = Auth::user()->school_id;
            $group->user_id = Auth::user()->id;
        });

        static::updating(function (Group $group) {
            $group->school_id = Auth::user()->school_id;
            $group->user_id = Auth::user()->id;
        });

    }
}
