<?php

namespace App\Services\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\User\SuccessStoryRepository;
class SuccessStoryService
{
    protected SuccessStoryRepository $repository;
    public function __construct(
        protected SuccessStoryRepository $successStoryRepository
    ) {
        $this->successStoryRepository=$successStoryRepository;
    }
    public function getPaginatedStories(int $perPage = 15): LengthAwarePaginator
    {
        return $this->successStoryRepository->paginate($perPage);
    }

    public function findById(int $id)
    {
        return $this->successStoryRepository->findById($id);
    }

}
