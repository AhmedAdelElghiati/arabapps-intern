<?php

namespace Database\Seeders;

use App\Models\CompletedItem;
use Illuminate\Database\Seeder;
use App\Models\Student;
class CompletedItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        CompletedItem::factory(300)
        ->recycle($students)
        ->create();
    }
}
