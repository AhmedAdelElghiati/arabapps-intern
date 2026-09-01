<?php

namespace App\Repositories\Eloquent;

use App\Models\SuccessStory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuccessStoryRepository
{
    public function __construct(
        protected SuccessStory $model
    ) {}

    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->newQuery()
            ->ordered()
            ->paginate($perPage);
    }

    

    public function findById(int $id): ?SuccessStory
    {
        return $this->model->newQuery()->find($id);
    }

    public function create(array $data): SuccessStory
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(SuccessStory $story, array $data): bool
    {
        return $story->update($data);
    }

    public function delete(SuccessStory $story): bool
    {
        return (bool) $story->delete();
    }
}
