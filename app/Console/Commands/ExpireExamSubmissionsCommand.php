<?php

namespace App\Console\Commands;

use App\Models\ExamSubmission;
use App\Services\User\ExamSubmissionService;
use Illuminate\Console\Command;

class ExpireExamSubmissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'examsubmissions:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It automatically ends any exam whose time has expired and is still pending.';

    /**
     * Execute the console command.
     */
    public function handle(ExamSubmissionService $examSubmissionService)
    {
        $expiredSubmissions = ExamSubmission::Expired()->get();

        if ($expiredSubmissions->isEmpty()) {
            $this->info('No expired exams found.');
            return self::SUCCESS;
        }

        foreach ($expiredSubmissions as $submission) {
            try {
                $examSubmissionService->submitExam($submission->toSubmitPayload(), forceExpired: true);
                $this->info("Submission #{$submission->id} expired & submitted.");
            } catch (\Throwable $e) {
                $this->error("Failed submission #{$submission->id}: {$e->getMessage()}");
                report($e);
            }
        }

        return self::SUCCESS;
    }
}
