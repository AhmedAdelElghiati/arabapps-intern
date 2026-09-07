<?php

namespace Database\Seeders;

use App\Models\LessonItem;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Exam;

    /**
     * Run the database seeds.
     */

class LessonItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = Lesson::all();
        $exams = Exam::all();
        LessonItem::factory(300)
        ->recycle($lessons)
        ->recycle($exams)
        ->create();
    }
}

