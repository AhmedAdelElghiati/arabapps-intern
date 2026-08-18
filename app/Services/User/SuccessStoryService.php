<?php

namespace App\Services\User;
use App\Models\SuccessStory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Eloquent\SuccessStoryRepository;
class SuccessStoryService
{
    public function __construct(
        protected SuccessStoryRepository $successStoryRepository
    ) {
    }
    public function getPaginatedStories(int $perPage = 15): LengthAwarePaginator
    {
        return $this->successStoryRepository->getPaginated($perPage);
    }
    
    public function findById(int $id)
    {
        return $this->successStoryRepository->findById($id);
    }

}
