<?php

namespace App\Models;

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
        'expired_at'  => 'datetime',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
