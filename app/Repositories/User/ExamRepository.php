<?php

namespace App\Repositories\User;

use App\Models\Exam;



class ExamRepository
{
    public function getAllExams(?string $search = null, ?string $track = null)
    {

        $exams = Exam::query()
            ->withCount('questions')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($track, function ($query) use ($track) {
                $query->where('track', $track);
            })
            ->paginate(15);
        return $exams;
    }

    public function getExamById(int $examId)
    {
        return Exam::with(['questions.examOptions'])->findOrFail($examId);
    }
}
