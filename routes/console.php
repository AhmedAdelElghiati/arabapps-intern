<?php

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('examsubmissions:expire')->everyMinute()->withoutOverlapping();
Artisan::command('student:count',function(){
    $count = \App\Models\Student::count();
    $this->info("Total Students: $count");
})->purpose('Display total number of students');
Artisan::command('course:count',function(){
    $count =(new Course)->print();
    $this->info("Total Courses: $count");
})->purpose('Display total number of courses');
//============
// Artisan::command('course:expire', function () {
//     (new Enrollment())->expired();
//     $this->info('the courses expired ');
// });
// Artisan::command('course:pendding', function () {
//     (new Enrollment())->pendding();
//     $this->info('the courses pendding ');
// });
// //============
Schedule::command('course:expire')->everyMinute()->withoutOverlapping();
// Schedule::command('course:pendding')->everyMinute();
// Artisan::command('question', function () {
//     $name = $this->ask('What is your name?');

//     $language = $this->choice('Which language do you prefer?', [
//         'PHP',
//         'Ruby',
//         'Python',
//     ]);

//     $this->line('Your name is '.$name.' and you prefer '.$language.'.');
// });

