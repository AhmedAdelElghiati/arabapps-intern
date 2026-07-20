<?php

namespace Database\Seeders;

use App\Models\ExamSubmission;
use Illuminate\Database\Seeder;

class ExamSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamSubmission::factory(150)->create();
    }
}
