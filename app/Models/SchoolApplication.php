<?php

namespace App\Models;

use App\Enums\SchoolApplicationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolApplication extends Model
{
     use HasFactory;
    use SoftDeletes;


    protected $fillable = [

        /*
        School Information
        */
        'school_name',
        'school_type',
        'location',
        'region',
        'district',


        /*
        Contact
        */
        'contact_name',
        'email',
        'phone',


        /*
        School Size
        */
        'student_count',
        'teacher_count',


        /*
        Application
        */
        'message',
        'status',


        /*
        Review
        */
        'reviewed_by',
        'reviewed_at',
        'admin_notes',

    ];


    protected function casts(): array
    {
        return [

            'status' => SchoolApplicationStatus::class,

            'reviewed_at' => 'datetime',

            'student_count' => 'integer',

            'teacher_count' => 'integer',

        ];
    }



    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    public function reviewer()
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }



    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */


    public function scopePending($query)
    {
        return $query->where(
            'status',
            SchoolApplicationStatus::PENDING
        );
    }


    public function scopeApproved($query)
    {
        return $query->where(
            'status',
            SchoolApplicationStatus::APPROVED
        );
    }



    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */


    public function approve(User $user): void
    {
        $this->update([

            'status' => SchoolApplicationStatus::APPROVED,

            'reviewed_by' => $user->id,

            'reviewed_at' => now(),

        ]);
    }



    public function reject(
        User $user,
        ?string $note = null
    ): void
    {
        $this->update([

            'status' => SchoolApplicationStatus::REJECTED,

            'reviewed_by' => $user->id,

            'reviewed_at' => now(),

            'admin_notes' => $note,

        ]);
    }
}
