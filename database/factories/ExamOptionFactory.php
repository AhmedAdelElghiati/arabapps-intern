<?php

namespace Database\Factories;

use App\Models\ExamOption;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;
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
            'question_id' => Question::factory(),
            'option_text' => fake()->sentence(3),
            'is_correct' => fake()->boolean,
        ];
    }
}
