<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\CompletedItem;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class My_CoursesController extends Controller
{
    use ApiResponder;
    public function index(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'per_page' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        Enrollment::where('expired_at', '<', now())->delete();
        // will return (course id - title - image url - description - duration - total items - completed items - progress percentage) for each course
        $search = $request->query('search');
        $courses = DB::table('courses')
        ->join('lessons', 'lessons.course_id', '=', 'courses.id')
        ->join('lesson_items', 'lesson_items.lesson_id', '=', 'lessons.id')
        ->leftJoin('completed_items', function ($join) use ($user) {
        $join->on('completed_items.lesson_item_id', '=', 'lesson_items.id')
             ->where('completed_items.user_id', '=', $user->id);
    })
    ->when($search, function ($query, $search) {
        return $query->where(function ($q) use ($search) {
            $q->where('courses.title', 'LIKE', "%{$search}%")
              ->orWhere('courses.description', 'LIKE', "%{$search}%");
        });
    })
    ->select(
        'courses.id',
        'courses.title',
        'courses.image_url',
        'courses.description',
        'courses.duration',
        DB::raw('COUNT(DISTINCT lesson_items.id) as total_items'),
        DB::raw('COUNT(DISTINCT completed_items.id) as completed_items_count'),
        DB::raw('ROUND((COUNT(DISTINCT completed_items.id) / COUNT(DISTINCT lesson_items.id)) * 100, 2) as progress_percentage')
    )->groupBy(
        'courses.id',
        'courses.title',
        'courses.image_url',
        'courses.description',
        'courses.duration'
    )
    ->paginate();
    
    return $this->respond([
            'data' => $courses,
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
