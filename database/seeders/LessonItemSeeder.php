<?php

namespace Database\Seeders;

use App\Models\LessonItem;
use Illuminate\Database\Seeder;

class LessonItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LessonItem::factory(200)->create();
    }
}
