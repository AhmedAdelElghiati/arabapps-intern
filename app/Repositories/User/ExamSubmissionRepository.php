<?php

namespace App\Repositories\User;

use App\Models\ExamSubmission;
use App\Models\StudentAnswer;

class ExamSubmissionRepository
{
    public function createExamSubmission(array $data)
    {
        return ExamSubmission::create($data);
    }

    public function countAttempts(int $studentId, int $examId): int
    {
        return ExamSubmission::where('student_id', $studentId)
            ->where('exam_id', $examId)
            ->count();
    }

    public function getActiveExamSubmission(int $studentId, int $examId, int $submissionId): ?ExamSubmission
    {
        return ExamSubmission::where('student_id', $studentId)
            ->where('exam_id', $examId)
            ->where('id', $submissionId)
            ->where('is_completed', false)
            ->first();
    }

    public function getFlaggedQuestions(int $studentId, int $examId, int $submissionId)
    {
        return StudentAnswer::with('question.examOptions')
            ->where('submission_id', $submissionId)
            ->whereHas('submission', function ($query) use ($studentId, $examId) {
                $query->where('student_id', $studentId)
                    ->where('exam_id', $examId);
            })
            ->where('is_flagged', true)
            ->orderBy('id')
            ->get();
    }
}
