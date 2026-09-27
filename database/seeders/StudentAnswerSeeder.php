<?php

namespace Database\Seeders;

use App\Models\StudentAnswer;
use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\ExamOption;
use App\Models\ExamSubmission;
class StudentAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #TODO: ExamOptions not same as choices in question, need to fix this
        $submissions = ExamSubmission::all();
        $questions   = Question::all();
        $choices     = ExamOption::all();

        StudentAnswer::factory(500)
            ->recycle($submissions)
            ->recycle($questions)
            ->recycle($choices)
            ->create();
    }
}
