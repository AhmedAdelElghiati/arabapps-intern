<?php

namespace App\Repositories\User;

use App\Models\SuccessStory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuccessStoryRepository
{

    public function all(): Collection
    {
        // Using get() instead of all() because all() cannot be chained after orderBy
        return SuccessStory::newQuery()->orderBy("created_at", "desc")->get();
    }

    public function paginate(?string $query = null, int $perPage = 15): LengthAwarePaginator
    {
        return SuccessStory::query()
        ->when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%");
        })
        ->paginate($perPage);
    }

    public function getPaginated(int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return SuccessStory::newQuery()
            ->ordered()
            ->paginate($perPage);
    }

    public function find(int $id)
    {
        return SuccessStory::newQuery()->find($id);
    }

    public function findById(int $id)
    {
        return SuccessStory::find($id);
    }

}
