<?php
namespace App\Services\User;
use App\Repositories\User\CourseRepository;

class CourseService
{
    // Define methods for course-related business logic here
    protected $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function getAllCourses()
    {    
         
       
        return $this->courseRepository->getAllCourses();
    }
    public function getCourseById($id){   
         
        return $this->courseRepository->getCourseById($id);;

    }

    public function enrollFreeCourse(int $studentId, int $courseId)
    {
        $course = $this->courseRepository->getCourseById($courseId);

        if (! $course->is_free) {
            return response()->json([
                'message' => 'Only free courses can be enrolled in this way.',
            ], 422);
        }

        return $this->courseRepository->enrollStudent($studentId, $courseId);
    }
}