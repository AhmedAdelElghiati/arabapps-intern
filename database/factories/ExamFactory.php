<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'type' => fake()->randomElement(['Mock', 'Course', 'Quiz' , 'Homework']),
            'score' => fake()->numberBetween(10, 100),
            'passing_score' => fake()->numberBetween(5, 50),
            'level' => fake()->randomElement(['10', '11', '12']),
            'duration' => fake()->randomElement([15, 30, 45, 60, 90 ,180]),
            'status' => fake()->randomElement(['active', 'draft', 'inactive']),
            'allowed_tries_count' => fake()->randomElement([1, 2, 3, null]),
            'created_by' => 1,
        ];
    }
}
