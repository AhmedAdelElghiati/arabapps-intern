<?php

namespace App\Console\Commands;

use App\Models\Enrollment;
use Illuminate\Console\Command;

class EnrollmentExpirationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:expire';

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
        $expired_enrollments = Enrollment::expired()->get();
        foreach ($expired_enrollments as $enrollment) {
            // dd($enrollment);
            $enrollment->setExpired();
        }
        return 0;
        //Task , make the same logic without foreach, use pluck or whatever you want in less than three queries;
        
    }
}
