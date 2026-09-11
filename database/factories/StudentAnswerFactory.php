<?php

namespace Database\Factories;

use App\Models\StudentAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'submission_id' => fake()->numberBetween(2, 150),
            'question_id' => fake()->numberBetween(1, 200),
            'choice_id' => fake()->numberBetween(1, 800),
        ];
    }
}
