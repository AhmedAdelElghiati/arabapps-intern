<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arabicTitles = [
            'أحدث الصور والفعاليات',
            'معرض الصور الخاص بنا',
            'فعاليات وأنشطة الشركة',
            'لحظات مميزة من فعالياتنا',
            'أبرز أعمالنا ومشاريعنا',
            'صور من أحدث فعالياتنا',
            'لقطات مميزة من أنشطتنا',
            'فعاليات ومناسبات خاصة',
            'مجموعة من أجمل اللحظات',
            'أهم الفعاليات والأنشطة',
        ];

        return [
            'title_en' => fake()->sentence(5),
            'title_ar' => fake()->randomElement($arabicTitles),
            'image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/800/600',
        ];
    }
}
