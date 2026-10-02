<?php

namespace Database\Factories;

use App\Models\StudentAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ExamSubmission;
use App\Models\Question;
use App\Models\ExamOption;
/**
 * @extends Factory<StudentAnswer>
 */
class StudentAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'submission_id' => ExamSubmission::factory(),
            'question_id' => Question::factory(),
            'choice_id' => ExamOption::factory(),
        ];
    }
}
