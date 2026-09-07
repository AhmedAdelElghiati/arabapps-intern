<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enrollments = Enrollment::all();
        Payment::factory(150)
        ->recycle($enrollments)
        ->create();
    }
}
