<?php

namespace Database\Factories;

use App\Models\CompletedItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\LessonItem;

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
            'student_id' => Student::factory(),
            'lesson_item_id' => LessonItem::factory(),
            'completed_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
