<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => fake()->sentence() . '?',
            'answer' => fake()->paragraph(),
            'category' => fake()->randomElement(['General', 'Courses', 'Payments', 'Technical', null]),
            'display_order' => fake()->numberBetween(1, 30),
            'publish_date' => fake()->boolean(70) ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'created_by' => 1,
        ];
    }
}
