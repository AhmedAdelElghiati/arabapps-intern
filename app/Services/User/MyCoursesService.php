<?php

namespace App\Services\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\User\MyCoursesRepository;
class MyCoursesService
{
    public function __construct(
        protected MyCoursesRepository $myCoursesRepository
    ) {
    }
    public function getPaginatedStories(int $perPage = 15): LengthAwarePaginator
    {
        return $this->myCoursesRepository->paginate($perPage);
    }
    public function findById(int $id)
    {
        return $this->myCoursesRepository->find($id);
    }
    public function getAllCoursesWithProgress($studentId , ?string $search = null)
    {

        $this->myCoursesRepository->checkAllCoursesExpired();
        return $this->myCoursesRepository->getAllCoursesWithProgress($studentId , $search);
    }
    public function getCourseWithProgress($studentId,$courseId){
    return $this->myCoursesRepository->getCourseWithProgress($studentId , $courseId);

    }

}
