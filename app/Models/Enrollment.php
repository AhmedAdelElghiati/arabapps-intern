<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
        'access_type',
        'enrolled_at',
        'expired_at',
        'status',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'expired_at' => 'datetime',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function scopeExpired(Builder $query)
    {
        return $query->whereNotNull('expired_at')->where('expired_at', '<', now());
        // ->update(['status' => 'Expired']);
    }

    public function setExpired()
    {
        return $this->update(['status'=> 'expired']);
    }
    public function pendding()
    {
        Enrollment::whereNotNull('expired_at')->where('expired_at', '>', now())->update(['status' => 'pennding']);
    }
}
