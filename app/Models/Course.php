<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
class Course extends Model
{
    use HasFactory;
    public function materials()
    {
        return $this->hasMany(CourseMaterial::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function lessonItems()
    {
        return $this->hasManyThrough(LessonItem::class, Lesson::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
