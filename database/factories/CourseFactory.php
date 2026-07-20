<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_published = fake()->boolean();
        return [
            'title' => fake()->sentence(),
            'image_url' => fake()->imageUrl(),
            'description' => fake()->paragraph(),
            'is_free' => fake()->boolean(),
            'price' => fake()->randomFloat(2, 0, 350),
            'discount' => fake()->randomFloat(2, 0, 350),
            'level' => fake()->randomElement(['10', '11', '12']),
            'duration' => fake()->randomElement([30,60,90,365]),
            'display_order' => fake()->numberBetween(1,100),
            'is_desmos_enabled' => fake()->boolean(),
            'show_at_home' => fake()->boolean(),
            'is_published' => $is_published,
            'created_by' => 1,
            'publish_date' => $is_published ? now()->subDays(rand(1, 365)) : null,
        ];
    }
}
