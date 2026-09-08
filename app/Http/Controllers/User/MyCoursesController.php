<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\CompletedItem;
use App\Models\CourseMaterial;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\User\MyCoursesService;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonItem;
use App\Models\Lesson;
use function Laravel\Prompts\progress;
use App\Http\Resources\CourseResource;
class MyCoursesController extends Controller
{
    use ApiResponder;
    public function __construct(
        protected MyCoursesService $myCoursesService
    ) {
    }
    public function index(){
    $studentId = Auth::id(); // what i have to do there
        $courses=$this->myCoursesService->getAllCoursesWithProgress($studentId);
        return $this->respond([
        'data' => CourseResource::collection($courses)
        ]);
    }
    public function show(int $courseId)
{
    $studentId = Auth::id();
    $course = $this->myCoursesService->getCourseWithProgress($studentId,$courseId);
        if(!$course){
            return $this->respond([
                'massage'=>'this user don\'t have this course'
            ]);
        }
        // Single model uses new CourseResource()
        return response()->json([
            'status' => 'success',
            'data'   => new CourseResource($course),
        ]);
}

}
