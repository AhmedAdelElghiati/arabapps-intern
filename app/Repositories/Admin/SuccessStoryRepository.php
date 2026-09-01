<?php

namespace App\Repositories\Admin;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\SuccessStory;
class SuccessStoryRepository
{
    public function all(): Collection
    {
        return SuccessStory::orderBy("created_at","desc")->all();
    }

    public function paginate(?string $query = null , int $perPage = 15) : LengthAwarePaginator
    {
        return SuccessStory::when($query, function ($q) use ($query) {;
            $q->where('title', 'like', "%{$query}%");
        })->paginate($perPage);
    }

    public function find(int $id): ?SuccessStory
    {
        return SuccessStory::find($id);
    }

    public function create(array $data): SuccessStory
    {
        return SuccessStory::create($data);
    }

    public function update(SuccessStory $successStory, array $data): bool
    {
        return $successStory->update($data);
    }

    public function delete(SuccessStory $successStory): bool
    {
        return $successStory->delete();
    }
}
