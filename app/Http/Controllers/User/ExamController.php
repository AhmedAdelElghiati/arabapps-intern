<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\ExamIndexRequest;
use App\Http\Resources\ExamResource;
use App\Services\User\ExamService;
use App\Traits\ApiResponder;

class ExamController extends Controller
{
    private ExamService $examService;

    use ApiResponder;
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function index(ExamIndexRequest $request)
    {
        $exams = $this->examService->getAllExams($request);
        return $this->respondResource(ExamResource::collection($exams), ['Exams retrieved successfully.']);
    }
}
