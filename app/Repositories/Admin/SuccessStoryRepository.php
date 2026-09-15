<?php

namespace App\Repositories\Admin;

use App\Models\SuccessStory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuccessStoryRepository
{
    public function __construct(
        protected SuccessStory $model
    ) {}

    public function all(): Collection
    {
        // Using get() instead of all() because all() cannot be chained after orderBy
        return $this->model->newQuery()->orderBy("created_at", "desc")->get();
    }

    public function paginate(?string $query = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->newQuery()->when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%");
        })->paginate($perPage);
    }

    public function getPaginated(int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model
            ->newQuery()
            ->ordered()
            ->paginate($perPage);
    }

    public function find(int $id): ?SuccessStory
    {
        return $this->model->newQuery()->find($id);
    }

    public function findById(int $id): ?SuccessStory
    {
        return $this->find($id);
    }

    public function create(array $data): SuccessStory
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(SuccessStory $successStory, array $data): bool
    {
        return $successStory->update($data);
    }

    public function delete(SuccessStory $successStory): bool
    {
        return (bool) $successStory->delete();
    }
}
