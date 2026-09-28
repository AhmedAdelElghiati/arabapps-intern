<?php

namespace App\Services\User;

use App\Exceptions\ExamSubmissionException;
use App\Repositories\User\ExamRepository;
use App\Repositories\User\ExamSubmissionRepository;
use App\Services\User\StudentAnswerService;

class ExamSubmissionService
{
    private ExamSubmissionRepository $examSubmissionRepository;
    private ExamRepository $examRepository;
    private StudentAnswerService $studentAnswerService;

    public function __construct(ExamSubmissionRepository $examSubmissionRepository, ExamRepository $examRepository, StudentAnswerService $studentAnswerService)
    {
        $this->examSubmissionRepository = $examSubmissionRepository;
        $this->examRepository = $examRepository;
        $this->studentAnswerService = $studentAnswerService;
    }

    public function getActiveExamSubmission(int $studentId, int $examId, int $submissionId)
    {
        return $this->examSubmissionRepository->getActiveExamSubmission($studentId, $examId, $submissionId);
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

        if (!is_null($maxAttempts) && $attempts >= $maxAttempts) {
            throw new ExamSubmissionException('Maximum attempts reached', 400);
        }

        $data['started_at'] = now();
        $data['completed_at'] = now()->addMinutes((float) $exam->duration);

        return $this->examSubmissionRepository->createExamSubmission($data);
    }


    public function submitExam(array $data, bool $forceExpired = false)
    {
        $examSubmission = $this->examSubmissionRepository->getActiveExamSubmission(
            $data['student_id'],
            $data['exam_id'],
            $data['submission_id']
        );

        if (!$examSubmission) {
            throw new ExamSubmissionException('No active exam submission found', 404);
        }

        if (!$forceExpired && $examSubmission->completed_at && now()->greaterThanOrEqualTo($examSubmission->completed_at)) {
            throw new ExamSubmissionException('Exam submission time has expired', 400);
        }

        $exam = $this->examRepository->getExamById($data['exam_id']);
        $correctChoicesByQuestion = [];

        foreach ($exam->questions as $question) {
            $correctChoicesByQuestion[$question->id] = $question->examOptions
                ->where('is_correct', true)
                ->pluck('id')
                ->all();
        }

        $score = 0.0;

        foreach ($data['answers'] as $answer) {
            $questionId = (int) $answer['question_id'];
            $choiceId = (int) $answer['choice_id'];

            $this->studentAnswerService->submitAnswer([
                'exam_id' => $data['exam_id'],
                'submission_id' => $examSubmission->id,
                'question_id' => $questionId,
                'choice_id' => $choiceId,
            ]);

            if (in_array($choiceId, $correctChoicesByQuestion[$questionId] ?? [], true)) {
                $question = $exam->questions->firstWhere('id', $questionId);
                $score += (float) ($question->mark ?? 0);
            }
        }

        $examSubmission->update([
            'score' => $score,
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        return $examSubmission;
    }
    public function flagQuestion(array $data)
    {
        $examSubmission = $this->examSubmissionRepository->getActiveExamSubmission(
            $data['student_id'],
            $data['exam_id'],
            $data['submission_id']
        );

        if (!$examSubmission) {
            throw new ExamSubmissionException('No active exam submission found', 404);
        }

        if ($examSubmission->completed_at && now()->greaterThanOrEqualTo($examSubmission->completed_at)) {
            throw new ExamSubmissionException('Exam submission time has expired', 400);
        }

        $answer = $examSubmission->answers()->firstOrCreate(
            ['question_id' => $data['question_id']]
        );
        $answer->update(['is_flagged' => $data['is_flagged']]);
    }

    public function getFlaggedQuestions(array $data)
    {
        $examSubmission = $this->examSubmissionRepository->getActiveExamSubmission(
            $data['student_id'],
            $data['exam_id'],
            $data['submission_id']
        );

        if (!$examSubmission) {
            throw new ExamSubmissionException('No active exam submission found', 404);
        }

        return $this->examSubmissionRepository->getFlaggedQuestions(
            $data['student_id'],
            $data['exam_id'],
            $data['submission_id']
        );
    }
}
