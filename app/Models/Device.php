<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Device extends Model
{
    //
    use HasFactory;
    protected $fillable=[
        'device_id',
        'student_id',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
