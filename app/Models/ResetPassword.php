<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{

    protected $fillable = [
        'phone',
        'reset_token',
        'created_at',
        'expires_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Helper to check if the record has expired.
     */
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }
}
