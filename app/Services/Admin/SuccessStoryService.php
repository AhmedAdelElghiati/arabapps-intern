<?php

namespace App\Services\Admin;

use App\Models\SuccessStory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SuccessStoryService
{
    public function getPaginatedStories(int $perPage = 15): LengthAwarePaginator
    {
        return SuccessStory::orderBy("created_at","desc")->paginate($perPage);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return SuccessStory::get();
    }

    public function createStory(array $data): SuccessStory
    {
        return SuccessStory::create($data);
    }

    public function updateStory(SuccessStory $successStory, array $data): bool
    {
        return $successStory->update($data);
    }

    public function deleteStory(SuccessStory $successStory): ?bool
    {
        return $successStory->delete();
    }
}
