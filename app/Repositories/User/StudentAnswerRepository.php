<?php

namespace App\Repositories\User;

use App\Models\StudentAnswer;



class StudentAnswerRepository
{
    public function submitAnswers(array $data)
    {
        return StudentAnswer::create($data);
    }
}
