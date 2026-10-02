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
            'name' => [
                'en'=>fake('en_US')->sentence(4),
                'ar'=>fake('ar_SA')->sentence(4),

            ],
            'description' => [
                'en'=>fake('en_US')->paragraph(),
                'ar'=>fake('ar_SA')->paragraph(),
            ],
            'photo_url' =>  fake()->imageUrl(300, 300, 'people'),
            'grade' => fake()->randomElement(['10', '11', '12', null]),
            'is_top_scored' => fake()->boolean(60),
        ];
    }
}
