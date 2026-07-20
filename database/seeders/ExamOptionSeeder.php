<?php

namespace Database\Seeders;

use App\Models\ExamOption;
use Illuminate\Database\Seeder;

class ExamOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamOption::factory(800)->create();
    }
}
