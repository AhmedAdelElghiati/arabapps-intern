<?php

namespace App\Services\User;

use App\Repositories\User\StudentAnswerRepository;

class StudentAnswerService
{
    private StudentAnswerRepository $studentAnswerRepository;
    public function __construct(StudentAnswerRepository $studentAnswerRepository)
    {
        $this->studentAnswerRepository = $studentAnswerRepository;
    }

    public function submitAnswers(array $data)
    {
        return $this->studentAnswerRepository->submitAnswers($data);
    }
}
