<?php

namespace Database\Factories;

use App\Models\ExamOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExamOption>
 */
class ExamOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_id' => fake()->numberBetween(1, 200),
            'option_text' => fake()->sentence(3),
            'is_correct' => fake()->boolean,
        ];
    }
}
