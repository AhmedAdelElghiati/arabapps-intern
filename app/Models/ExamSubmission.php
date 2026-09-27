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
        'score',
        'is_completed',
        'started_at',
        'completed_at'
    ];

    public function flaggedQuestions()
    {
        return $this->hasMany(StudentAnswer::class, 'submission_id')
            ->where('is_flagged', true);
    }

    public function answers()
    {
        return $this->hasMany(StudentAnswer::class, 'submission_id');
    }
}
