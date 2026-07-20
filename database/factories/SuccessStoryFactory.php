<?php

namespace Database\Factories;

use App\Models\SuccessStory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SuccessStory>
 */
class SuccessStoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => 1,
            'name' => fake()->name(),
            'photo_url' =>  fake()->imageUrl(300, 300, 'people'),
            'grade' => fake()->randomElement(['10', '11', '12', null]),
            'is_top_scored' => fake()->boolean(60),
        ];
    }
}
