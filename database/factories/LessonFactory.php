<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => fake()->numberBetween(1, 30),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'is_free' => fake()->boolean(),
            'publish_date' => now()->subDays(rand(1, 365)),
            'created_by' => 1,
        ];
    }
}
