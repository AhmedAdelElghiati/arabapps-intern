<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Enrollment;

class ExpireEnrollments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enrollments:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = Enrollment::needsExpiration()->update([
            'status' => 'expired'
        ]);
    }
}
