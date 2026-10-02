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
    public function getAllCourses(bool $hasFree, bool $hasPaid)
    {
        return $this->courseRepository->getAllCourses($hasFree, $hasPaid);
    }
    public function getCourseById($id)
    {

        return $this->courseRepository->getCourseById($id);
        ;

    }
    public function enrollFreeCourse(int $studentId, int $courseId)
    {
        $course = $this->courseRepository->getCourseById($courseId);

        if (!$course->is_free) {
            return [
                'status' => 'not_free',
            ];
        }

        $enrollment = $this->courseRepository->getEnrollment($courseId, $studentId );

        if ($enrollment) {
            return [
                'status' => 'already_enrolled',
            ];
        }

        return [
            'status' => 'enrolled',
            'enrollment' => $this->courseRepository->enrollStudent($studentId, $courseId),
        ];
    }


}