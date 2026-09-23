<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// TODO: Need to check if in the paid course we make the status pending not active 
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
    public function scopeActive($query){ // use Active without scope
        return $query->where('status','active');
    }
    public function scopeNeedExpiration($query)
    {
        return $query->whereIn('status', ['active', 'pending'])
        ->where('end_date', '<', now());
    }

}
