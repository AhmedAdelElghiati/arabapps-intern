<?php

namespace App\Services\User;

use App\Exceptions\ExamSubmissionException;
use App\Repositories\User\StudentAnswerRepository;

class StudentAnswerService
{
    private StudentAnswerRepository $studentAnswerRepository;
    private ExamService $examService;
    public function __construct(
        StudentAnswerRepository $studentAnswerRepository,
        ExamService $examService
    ) {
        $this->studentAnswerRepository = $studentAnswerRepository;
        $this->examService = $examService;
    }

    public function submitAnswers(array $data)
    {
        return $this->studentAnswerRepository->submitAnswers($data);
    }
    public function submitAnswer(array $data)
    {
        if (!$this->examService->isQuestionExist($data['exam_id'], $data['question_id'])) {
            throw new ExamSubmissionException('The specified question does not exist in the given exam.');
        }

        return $this->studentAnswerRepository->submitAnswer($data);
    }
}
