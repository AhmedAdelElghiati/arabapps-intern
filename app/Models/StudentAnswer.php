<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'question_id',
        'choice_id',
        'is_flagged',
    ];

    public function submission()
    {
        return $this->belongsTo(ExamSubmission::class, 'submission_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
