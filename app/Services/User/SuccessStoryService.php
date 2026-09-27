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
    public function getPaginatedStories($query ): LengthAwarePaginator
    {
        // dd($query);
        return $this->successStoryRepository->getAllSuccessStory($query);
    }

    public function findById(int $id)
    {
        return $this->successStoryRepository->getSuccessStoryById($id);
    }

}
