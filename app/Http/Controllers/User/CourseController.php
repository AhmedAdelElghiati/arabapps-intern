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
    public function index(Request $request)
    {
        $hasFree = $request->boolean('free');
        $hasPaid = $request->boolean('paid');
        $courses = $this->courseService->getAllCourses($hasFree, $hasPaid);
        
        return $this->respondResource(CourseResource::collection($courses));
    }

    public function show($id)
    {
        $course = $this->courseService->getCourseById($id);

        return $this->respondResource(
            new CourseResource($course)
        );
    }
    public function enroll(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ]);

        $result = $this->courseService->enrollFreeCourse($request->user('student')->id, $validated['course_id']);

        if ($result['status'] === 'not_free') {
            return $this->respondWithError(__('pages/courses.only_free_courses'), 422);
        }

        if ($result['status'] === 'already_enrolled') {
            return $this->respondWithError(__('pages/courses.already_enrolled'), 409);
        }

        return $this->respondSuccess(
            __('pages/courses.course_enrolled_successfully'),
            ['enrollment' => $result['enrollment']],
            201
        );
    }
}
