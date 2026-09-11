<?php

namespace App\Repositories\User;

use App\Models\ExamSubmission;



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
}
