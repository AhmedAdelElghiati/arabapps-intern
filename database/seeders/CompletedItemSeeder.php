<?php

namespace Database\Seeders;

use App\Models\CompletedItem;
use Illuminate\Database\Seeder;

class CompletedItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompletedItem::factory(300)->create();
    }
}
