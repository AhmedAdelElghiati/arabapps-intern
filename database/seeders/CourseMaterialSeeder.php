<?php

namespace Database\Seeders;

use App\Models\CourseMaterial;
use Illuminate\Database\Seeder;
use App\Models\Course;
class CourseMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        CourseMaterial::factory(100)
        ->recycle($courses)
        ->create();
    }
}
