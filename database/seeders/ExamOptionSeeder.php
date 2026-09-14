<?php

namespace Database\Seeders;

use App\Models\ExamOption;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ExamOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions=Question::all();
        ExamOption::factory(800)
            ->recycle($questions)
            ->create();
    }
}
