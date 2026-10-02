<?php

namespace App\Repositories\User;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Enrollment;
class MyCoursesRepository
{
    public function paginate(?string $query = null , int $perPage = 15) : LengthAwarePaginator
    {
        return Course::when($query, function ($q) use ($query) {;
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->paginate($perPage);
    }

    public function find(int $id): ?Course
    {
        return Course::find($id);
    }
    public function checkAllCoursesExpired()
    {
        Enrollment::where('expired_at', '<', now())->delete();
        return true;
    }
    public function getAllCoursesWithProgress($studentId , ?string $search = null)
    {
        $courses = Course::query()
        ->with([
            'lessons.lessonItems.completedItems' => function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            },
            'enrollments' => function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            },
        ])
        ->withCount([
            'lessonItems as total_items_count',
            'lessonItems as completed_items_count' => function ($query) use ($studentId) {
                $query->whereHas('completedItems', function ($q) use ($studentId) {
                    $q->where('student_id', $studentId);
                });
            },
        ])
        ->whereHas('enrollments', function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        })
        ->paginate();

    return $courses;
    }
    public function getCourseWithProgress($studentId,$courseId){
        return Course::query()
            ->where('id', $courseId)
            ->with([
                'materials',
                'lessons.lessonItems.completedItems' => fn ($q) => $q->where('student_id', $studentId),
                'enrollments' => fn ($q) => $q->where('student_id', $studentId),
            ])
            ->withCount([
                'lessonItems as total_items_count',
                'lessonItems as completed_items_count' => fn ($q) =>
                    $q->whereHas('completedItems', fn ($c) => $c->where('student_id', $studentId)),
            ])
            ->firstOrFail();
    }
}
