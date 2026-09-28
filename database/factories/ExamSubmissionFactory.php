<?php

namespace Database\Factories;

use App\Models\ExamSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Exam;
/**
 * @extends Factory<ExamSubmission>
 */
class ExamSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_completed = fake()->boolean();
        $started_at = now()->subDays(rand(1, 365));

        return [
            'student_id' => Student::factory(),
            'exam_id' => Exam::factory(),
            'score' => $is_completed ? fake()->randomFloat(2, 0, 100) : null,
            'is_completed' => $is_completed,
            'started_at' => $started_at,
            'completed_at' => $is_completed ? fake()->dateTimeBetween($started_at, 'now') : null,
        ];
    }
}
