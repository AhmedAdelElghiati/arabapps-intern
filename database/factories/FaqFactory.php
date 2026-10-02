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
            'question' => [
                'en' => fake()->sentence() . '?',
                'ar' => 'كيف يمكنني التسجيل؟',
            ],
            'answer' => [
                'en' => fake()->paragraph(),
                'ar' => 'يمكنك التسجيل من صفحة الكورس.',
            ],
            'category' => fake()->boolean(80) ? [
                'en' => fake()->randomElement(['General', 'Courses', 'Payments', 'Technical']),
                'ar' => 'عام',
            ] : null,
            'display_order' => fake()->numberBetween(1, 30),
            'publish_date' => fake()->boolean(70) ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'created_by' => 1,
        ];
    }
}
