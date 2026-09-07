<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\CompletedItem;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\User\MyCoursesService;
use Illuminate\Support\Facades\Auth;

class MyCoursesController extends Controller
{
    use ApiResponder;
    public function __construct(
        protected MyCoursesService $myCoursesService
    ) {
    }
    public function index(){
        $user = 1;
        $enrollments = Enrollment::all();
            return $this->respond([
                'data' => $enrollments,
            ]);
    }
    public function showCourse(Request $request,$id){

    $user = $request->user();

    $course = Course::with('lessons.lessonItems')->find($id);

    if (!$course) {
        return $this->respondNotFound('Course not found');
    }

    $completedItemIds = CompletedItem::where('user_id', $user->id)
        ->pluck('lesson_item_id') // mean select this column only from completed_items table
        ->toArray();

    $course->lessons->each(function ($lesson) use ($completedItemIds) {
        $lesson->lessonItems->transform(function ($item) use ($completedItemIds) {
            $item->is_completed = in_array($item->id, $completedItemIds);
            return $item;
        });
    });

    return $this->respond([
        'data' => $course,
    ]);

}
    public function showLessonItem(Request $request, $courseId, $lessonId)
    {
        $user = $request->user();
        $enrollment = Enrollment::where('user_id', $user->id)
                    ->where('course_id', $courseId)
                    ->first();

        if (!$enrollment) {
            return $this->respondNotFound('Enrollment not found');
        }

        $lesson = $enrollment->course->lessons()->where('id', $lessonId)->first();

        if (!$lesson) {
            return $this->respondNotFound('Lesson not found');
        }

        return $this->respond([
            'data' => $lesson,
        ]);
    }
}
