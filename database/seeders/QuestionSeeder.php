<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use App\Models\Exam;
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = Exam::all();
        Question::factory(120)
        ->recycle($exams)
        ->create();
    }
}
