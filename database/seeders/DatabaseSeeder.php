<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            ExamSeeder::class,
            CourseMaterialSeeder::class,
            LessonItemSeeder::class,
            QuestionSeeder::class,
            ExamOptionSeeder::class,
            ExamSubmissionSeeder::class,
            StudentAnswerSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}
