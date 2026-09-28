<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    protected $casts = [
        'is_completed' => 'boolean'
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
    public function scopeExpired(Builder $query)
    {
        return $query
            ->where('is_completed', false)
            ->whereNotNull('completed_at')
            ->where('completed_at', '<=', now());
    }
    public function toSubmitPayload(): array
    {
        return [
            'student_id'    => $this->student_id,
            'exam_id'       => $this->exam_id,
            'submission_id' => $this->id,
            'answers'       => $this->answers
                ->map(fn($a) => [
                    'question_id' => $a->question_id,
                    'choice_id'   => $a->choice_id,
                ])
                ->all(),
        ];
    }
}
