<?php

use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\User\ExamSubmissionController;
use App\Enum\TokenAbility;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\SuccessStoryApiController;
use App\Http\Controllers\User\FaqsController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\StudentAnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\MyCoursesController;
use App\Http\Middleware\LangApiMiddleware;

// =========================================================================
// PUBLIC & SPECIAL ROUTES
// =========================================================================
Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:6,1');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->middleware('throttle:6,1');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/guest', [AuthController::class, 'guest'])->middleware('throttle:6,1');

    // Refresh token uses a specific ability separate from standard endpoints
    Route::post('/refresh', [AuthController::class, 'refresh'])
        ->middleware(['auth:student', 'ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value]);
});

// =========================================================================
// AUTHENTICATED ROUTES (Requires Valid Access Token)
// =========================================================================
Route::middleware(['auth:student', 'ability:' . TokenAbility::ACCESS_API->value])->group(function () {

    // User Profile & Actions
    Route::prefix('user')->group(function () {
        Route::get('/profile', [AuthController::class, 'student_profile'])->middleware('student.full');
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // My Courses (Full students only)
    Route::prefix('my-courses')->middleware('student.full')->group(function () {
        Route::get('/', [MyCoursesController::class, 'index']);
        Route::get('/{id}', [MyCoursesController::class, 'show']);
    });

    // FAQs
    Route::controller(FaqsController::class)->prefix('faqs')->as('faqs.')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

    // Gallery
    Route::prefix('gallery')->group(function () {
        Route::get('/', [GalleryController::class, 'index']);
        Route::get('/{gallery}', [GalleryController::class, 'show']);
    });

    // Exams
    Route::prefix('exams')->group(function () {
        Route::get('/', [ExamController::class, 'index']);
        Route::get('/{examId}', [ExamController::class, 'show']);
        Route::post('/{examId}/start', [ExamSubmissionController::class, 'createExamSubmission']);
        Route::post('/{examId}/{submissionId}/{questionId}/answer', [StudentAnswerController::class, 'submitAnswer']);
        Route::post('/{examId}/submit', [ExamSubmissionController::class, 'submitExam']);
        Route::post('/{examId}/{submissionId}/{questionId}/flag', [ExamSubmissionController::class, 'flagQuestion']);
        Route::get('/{examId}/{submissionId}/flagged-questions', [ExamSubmissionController::class, 'getFlaggedQuestions']);
    });

    // Success Stories
    Route::prefix('success-story')->middleware([LangApiMiddleware::class])->group(function () {
        Route::get('/', [SuccessStoryApiController::class, 'index']);
        Route::get('/{success_story}', [SuccessStoryApiController::class, 'show']);
    });

    // Courses
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::post('/enroll', [CourseController::class, 'enroll'])->middleware('student.full');
        Route::get('/{id}', [CourseController::class, 'show']);
    });
});