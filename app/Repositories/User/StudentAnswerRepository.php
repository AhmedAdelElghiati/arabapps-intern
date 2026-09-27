<?php

namespace App\Repositories\User;

use App\Models\StudentAnswer;



class StudentAnswerRepository
{
    public function submitAnswers(array $data)
    {
        return StudentAnswer::create($data);
    }
    public function submitAnswer(array $data)
    {
        return StudentAnswer::updateOrCreate(
            [
                'submission_id' => $data['submission_id'],
                'question_id' => $data['question_id'],
            ],
            [
                'choice_id' => $data['choice_id'],
            ]
        );
    }
}
