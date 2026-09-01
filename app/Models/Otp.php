<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otp';

    protected $fillable = [
        'device_id',
        'otp_code',
        'expires_at',
        'data',
        'phone'
    ];

    protected $casts = [
        'data' => 'array',          // Automatically serializes/deserializes JSON
        'expires_at' => 'datetime', // Casts timestamp to Carbon instance
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class, 'device_id', 'device_id');
    }
}
