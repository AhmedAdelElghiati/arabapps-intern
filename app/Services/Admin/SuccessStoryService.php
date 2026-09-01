<?php

namespace App\Services\Admin;

use App\Models\SuccessStory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Admin\SuccessStoryRepository;
class SuccessStoryService
{
    private SuccessStoryRepository $successStoryRepository;
    public function __construct(
        protected SuccessStoryRepository $SuccessStoryRepository
    ) {
        $this->successStoryRepository = $SuccessStoryRepository;
    }
    public function getPaginatedStories(int $perPage = 15): LengthAwarePaginator
    {
        return $this->successStoryRepository->paginate($perPage);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->successStoryRepository->all();
    }

    public function createStory(array $data): SuccessStory
    {
        return $this->successStoryRepository->create($data);
    }

    public function updateStory(SuccessStory $successStory, array $data): bool
    {
        return $this->successStoryRepository->update($successStory, $data);
    }

    public function deleteStory(SuccessStory $successStory): ?bool
    {
        return $this->successStoryRepository->delete($successStory);
    }
}
