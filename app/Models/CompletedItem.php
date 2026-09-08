<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\LessonItem;
class CompletedItem extends Model
{
    use HasFactory;
    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function lessonItem()
    {
        return $this->belongsTo(LessonItem::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
