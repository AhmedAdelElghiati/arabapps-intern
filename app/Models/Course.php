<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
