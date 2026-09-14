<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Student;
class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $students = Student::all();
        Enrollment::factory(300)
            ->recycle($courses)
            ->recycle($students)
            ->create();
    }
}
