<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\CourseService;
use App\Traits\ApiResponder;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
class CourseController extends Controller
{
    //
    use ApiResponder;
    private $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return response()->json([
            'courses' => $courses,
        ]);

    }

    public function show($id)
    {
        $course = $this->courseService->getCourseById($id);


        if (!$course) {
            return $this->respondNotFound('Course not found');
        }


        return $this->respondResource(
            new CourseResource($course)
        );


    }
    public function enroll(Request $request){
        $validated = $request->validate([
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ]);

        $enrollment = $this->courseService->enrollFreeCourse(
            $request->user('student')->id,
            $validated['course_id']
        );

        if (! $enrollment) {
            return response()->json([
                'message' => 'Only free courses can be enrolled in this way.',
            ], 422);
        }

        return response()->json([
            'message' => 'Course enrolled successfully.',
            'enrollment' => $enrollment,
        ], 201);
    }
}
