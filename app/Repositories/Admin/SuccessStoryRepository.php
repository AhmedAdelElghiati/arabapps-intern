<?php

namespace App\Repositories\Admin;

use App\Models\Gallery;
use App\Models\SuccessStory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuccessStoryRepository
{

    public function all(): Collection
    {
        // Using get() instead of all() because all() cannot be chained after orderBy
        return SuccessStory::query()->orderBy("created_at", "desc")->get();
    }

    public function paginate(?string $query = null, int $perPage = 15): LengthAwarePaginator
    {
        return SuccessStory::query()->paginate($perPage);
        // dd($x);
        //  $x;
    }

    public function getPaginated(int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return SuccessStory::query()
            ->ordered()
            ->paginate($perPage);
    }

    public function find(int $id): ?SuccessStory
    {
        return SuccessStory::query()->find($id);
    }

    public function findById(int $id): ?SuccessStory
    {
        return $this->find($id);
    }

    public function create(array $data): SuccessStory
    {
        return SuccessStory::create([
            'name' => $data['name'],               // ['en' => '...', 'ar' => '...']
            'track' => $data['track'] ?? null,     // ['en' => '...', 'ar' => '...']
            'description' => $data['description'] ?? null,
            'grade' => $data['grade'] ?? null,
            'display_order' => $data['display_order'] ?? 0,
            'is_top_scored' => $data['is_top_scored'] ?? false,
            'is_active' => $data['is_active'] ?? true,
            'photo' => $data['photo'] ?? null,
        ]);
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
