<?php

namespace Database\Factories;

use App\Models\CourseMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
/**
 * @extends Factory<CourseMaterial>
 */
class CourseMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => fake()->sentence(4),
            'url' => fake()->optional()->url(),
            'created_by' => 1,
        ];
    }
}
