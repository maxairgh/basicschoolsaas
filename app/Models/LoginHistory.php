<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginHistory extends Model
{
    protected $fillable = [
        'user_id',
        'guard',
        'authentication_method',
        'login_type',
        'successful',
        'failure_reason',
        'login_at',
        'logout_at',
        'session_id',
        'ip_address',
        'device_type',
        'platform',
        'browser',
        'user_agent',
        'country_code',
        'country',
        'city',
        'application',
        'token_id',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'successful' => 'boolean',
            'login_at' => 'datetime',
            'logout_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}