<?php

namespace Database\Seeders;

use App\Models\CompletedItem;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\LessonItem;
class CompletedItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $lessonItems = LessonItem::all();
        CompletedItem::factory(280)
        ->recycle($students)
        ->recycle($lessonItems)
        ->create();
    }
}
