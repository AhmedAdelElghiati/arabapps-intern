<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exam_id' => fake()->numberBetween(1, 50),
            'mark' => fake()->randomElement([1, 1.5, 2, 3]),
            'text' => fake()->sentence() . '?',
            'created_by' => 1,
        ];
    }
}
