<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\Submissions\ExamSubmissionCreateRequest;
use App\Services\User\ExamSubmissionService;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExamSubmissionResource;

class ExamSubmissionController extends Controller
{
    private ExamSubmissionService $examService;

    use ApiResponder;
    public function __construct(ExamSubmissionService $examService)
    {
        $this->examService = $examService;
    }
    public function createExamSubmission(int $examId)
    {
        $data = [
            'exam_id' => $examId,
            'student_id' => Auth::id(),
            'started_at' => now()
        ];

        $examSubmission = $this->examService->createExamSubmission($data);

        return $this->respond(new ExamSubmissionResource($examSubmission), ['Exam submission created successfully.']);
    }
}
