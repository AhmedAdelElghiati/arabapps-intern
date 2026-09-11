<?php

namespace App\Services\User;

use App\Exceptions\ExamSubmissionException;
use App\Repositories\User\ExamRepository;
use App\Repositories\User\ExamSubmissionRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExamSubmissionService
{
    private ExamSubmissionRepository $examSubmissionRepository;
    private ExamRepository $examRepository;

    public function __construct(ExamSubmissionRepository $examSubmissionRepository, ExamRepository $examRepository)
    {
        $this->examSubmissionRepository = $examSubmissionRepository;
        $this->examRepository = $examRepository;
    }
    public function createExamSubmission(array $data)
    {
        $exam = $this->examRepository->getExamById($data['exam_id']);

        if (!$exam) {
            throw new ExamSubmissionException('Exam not found', 404);
        }

        if ($exam->status !== 'active') {
            throw new ExamSubmissionException('Exam is not active', 400);
        }

        $maxAttempts = $exam->allowed_tries_count;
        $attempts = $this->examSubmissionRepository->countAttempts($data['student_id'], $data['exam_id']);
        if ($attempts >= $maxAttempts) {
            throw new ExamSubmissionException('Maximum attempts reached', 400);
        }

        $data['completed_at'] = now()->addMinutes((float) $exam->duration);

        return $this->examSubmissionRepository->createExamSubmission($data);
    }
}
