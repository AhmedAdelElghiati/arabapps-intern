<?php

namespace Database\Seeders;

use App\Models\ExamSubmission;
use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Student;

class ExamSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students= Student::all();
        $exams = Exam::all();
        ExamSubmission::factory(10)
        ->recycle($students)
        ->recycle($exams)
        ->create();
    }
}
