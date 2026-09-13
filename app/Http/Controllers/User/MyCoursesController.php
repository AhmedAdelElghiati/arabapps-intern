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

use App\Http\Resources\CourseResource;
class MyCoursesController extends Controller
{
    use ApiResponder;
    public function __construct(
        protected MyCoursesService $myCoursesService
    ) {
    }
    public function index(){
        $studentId = authUser('student')->id;
        $courses=$this->myCoursesService->getAllCoursesWithProgress($studentId);
        if($courses->isEmpty()){
            return $this -> respondWithError(__('pages/myCourses.index'));
        }

        return $this->respondResource(CourseResource::collection($courses));
    }
    public function show(int $courseId)
{
    $studentId = authUser('student')->id;
    $course = $this->myCoursesService->getCourseWithProgress($studentId,$courseId);
        if(!$course){
            return $this -> respondWithError(__('pages/myCourses.show'));
        }
        return $this->respondResource(new CourseResource($course));
        // Single model uses new CourseResource()

        // api responder
        // one structure

        // magic method
}

}
