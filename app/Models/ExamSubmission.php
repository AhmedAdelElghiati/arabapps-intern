<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'exam_id',
        'started_at',
        'completed_at'
    ];
}
