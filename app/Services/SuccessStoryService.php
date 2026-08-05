<?php

namespace App\Services;

use App\Models\SuccessStory;
use App\Repositories\Contracts\SuccessStoryRepositoryInterface;
use App\Services\Interfaces\SuccessStoryServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuccessStoryService implements SuccessStoryServiceInterface
{
    public function __construct(
        protected SuccessStoryRepositoryInterface $storyRepository
    ) {}

    public function listPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->storyRepository->getPaginated($perPage);
    }

    public function listTopScored(): Collection
    {
        return $this->storyRepository->getTopScored();
    }

    public function findById(int $id): SuccessStory
    {
        $story = $this->storyRepository->findById($id);

        if (!$story) {
            abort(404, 'Success Story not found.');
        }

        return $story;
    }

    public function createStory(array $data, int $authorId): SuccessStory
    {
        $data['created_by'] = $authorId;

        return $this->storyRepository->create($data);
    }

    public function updateStory(int $id, array $data): SuccessStory
    {
        $story = $this->findById($id);
        $this->storyRepository->update($story, $data);

        return $story;
    }

    public function deleteStory(int $id): bool
    {
        $story = $this->findById($id);

        return $this->storyRepository->delete($story);
    }
}
