<?php

namespace App\Models;

use App\Enums\SchoolApplicationStatus;
use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolApplication extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [

        /*School Information*/
        'school_name',
        'school_type',
        'location',
        'region_id',
        'district_id',

        /*Contact*/
        'contact_person_firstname',
        'contact_person_lastname',
        'email',
        'phone',

        /*School Size*/
        'student_count',
        'teacher_count',

        /*Application*/
        'message',
        'status',

        /* Review */
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

    public function approve(User $user, ?string $note = null): void
    {
        $this->update([
            'status' => SchoolApplicationStatus::APPROVED,
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
             'admin_notes' => $this->admin_notes ."\n\n" . now() . "\n" . $note,
        ]);
    }

    public function reject( User $user, ?string $note = null ): void
    {
        $this->update([
            'status' => SchoolApplicationStatus::REJECTED,
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
            'admin_notes' =>  $this->admin_notes ."\n\n" . now() . "\n" . $note,
        ]);
    }

    /**
     * Get the region where the school is located.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the district where the school is located.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
