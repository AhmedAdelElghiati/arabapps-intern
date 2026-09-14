<?php
namespace App\Repositories\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;

class CourseRepository
{
    // Define methods for course-related database operations here
    public function getAllCourses(bool $hasFree, bool $hasPaid)
    {
        $query = Course::query();
        if ($hasFree) {
            $query->where('is_free', true);
        }
        if ($hasPaid) {
            $query->where('is_free', false);
        }
        return $query->paginate(10)->withQueryString();
    }
    public function getCourseById($id)
    {
            return Course::with(['lessons.items','materials',])->findOrFail($id);
    }
    public function getEnrollment($courseId,$studentId )
    {
        return Enrollment::where('course_id', $courseId)->where('student_id', $studentId)->first();
    }

    public function enrollStudent(int $studentId, int $courseId)
    {
        return Enrollment::create(
            [
                'student_id' => $studentId,
                'course_id' => $courseId,
                'access_type' => 'free',
                'enrolled_at' => now(),
                'status' => 'active',
            ]
        );
    }
  
}