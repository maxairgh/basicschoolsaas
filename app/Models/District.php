<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    protected $fillable = [
        'region_id',
        'district_name',
        'district_capital',
        'district_category',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
