<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StudentAnswerRequest;
use App\Http\Resources\StudentAnswerResource;
use App\Services\User\StudentAnswerService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class StudentAnswerController extends Controller
{
    use ApiResponder;
    private StudentAnswerService $studentAnswerService;

    public function __construct(StudentAnswerService $studentAnswerService)
    {
        $this->studentAnswerService = $studentAnswerService;
    }

    public function submitAnswer(StudentAnswerRequest $request, int $examId, int $submissionId, int $questionId)
    {

        $data = $request->validated();
        $data['exam_id'] = $examId;
        $data['submission_id'] = $submissionId;
        $data['question_id'] = $questionId;
        $answer = $this->studentAnswerService->submitAnswer($data);

        return $this->respondResource(new StudentAnswerResource($answer), ['Answer submitted successfully.']);
    }
}
