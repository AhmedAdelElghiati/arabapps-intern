<?php

namespace Database\Factories;

use App\Models\CompletedItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompletedItem>
 */
class CompletedItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => fake()->numberBetween(1, 50),
            'lesson_item_id' => fake()->numberBetween(1, 200),
            'completed_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
