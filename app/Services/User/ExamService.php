<?php

namespace App\Services\User;

use App\Http\Requests\Exams\ExamIndexRequest;
use App\Repositories\User\ExamRepository;

class ExamService
{
    private ExamRepository $examRepository;
    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }
    public function getAllExams(ExamIndexRequest $request)
    {
        $search = $request->validated()['query'] ?? null;
        $track = $request->validated()['track'] ?? null;

        return $this->examRepository->getAllExams($search, $track);
    }
}
