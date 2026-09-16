<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\Submissions\SubmitAnswerRequest;
use App\Services\User\ExamSubmissionService;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExamSubmissionResource;
use App\Http\Resources\FlaggedQuestionResource;

class ExamSubmissionController extends Controller
{
    private ExamSubmissionService $examSubmissionService;

    use ApiResponder;
    public function __construct(ExamSubmissionService $examSubmissionService)
    {
        $this->examSubmissionService = $examSubmissionService;
    }
    public function createExamSubmission(int $examId)
    {
        $data = [
            'exam_id' => $examId,
            'student_id' => Auth::id(),
            'started_at' => now()
        ];

        $examSubmission = $this->examSubmissionService->createExamSubmission($data);

        return $this->respond(new ExamSubmissionResource($examSubmission), ['Exam submission created successfully.']);
    }

    public function submitExam(SubmitAnswerRequest $request, int $examId)
    {
        $data = [
            'exam_id' => $examId,
            'student_id' => Auth::id(),
            'submission_id' => $request->validated('submission_id'),
            'answers' => $request->validated('answers'),
        ];

        $examSubmission = $this->examSubmissionService->submitExam($data);

        return $this->respond(new ExamSubmissionResource($examSubmission), ['Exam submitted successfully.']);
    }

    public function flagQuestion(int $examId, int $submissionId, int $questionId)
    {
        $data = [
            'exam_id' => $examId,
            'student_id' => Auth::id(),
            'submission_id' => $submissionId,
            'question_id' => $questionId,
            'is_flagged' => true,
        ];

        $this->examSubmissionService->flagQuestion($data);

        return $this->respondWithSuccess('Question flagged successfully');
    }

    public function getFlaggedQuestions(int $examId, int $submissionId)
    {
        $data = [
            'exam_id' => $examId,
            'student_id' => Auth::id(),
            'submission_id' => $submissionId,
        ];

        $flaggedQuestions = $this->examSubmissionService->getFlaggedQuestions($data);

        return $this->respondResource(FlaggedQuestionResource::collection($flaggedQuestions), ['Flagged questions retrieved successfully.']);
    }
}
