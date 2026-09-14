<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\LessonItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Exam;
/**
 * @extends Factory<LessonItem>
 */
class LessonItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['video', 'file', 'exam']);
        return [
            'lesson_id' => Lesson::factory(),
            'title' => fake()->sentence(),
            'type' => $type,
            'display_order' => fake()->numberBetween(1, 20),
            'url' => $type !== 'exam' ? fake()->url() : null,
            'exam_id' => $type === 'exam' ? Exam::factory() : null,
            'is_free' => fake()->boolean(),
            'publish_date' => now()->subDays(rand(1, 365)),
            'created_by' => 1,
        ];
    }
}
