<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
     protected $fillable = [
        'region_name',
        'region_capital',
    ];

        public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
