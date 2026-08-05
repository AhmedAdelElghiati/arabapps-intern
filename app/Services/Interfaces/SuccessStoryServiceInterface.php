<?php

namespace App\Services\Interfaces;

use App\Models\SuccessStory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface SuccessStoryServiceInterface
{
    public function listPaginated(int $perPage = 15): LengthAwarePaginator;

    public function listTopScored(): Collection;

    public function findById(int $id): SuccessStory;

    public function createStory(array $data, int $authorId): SuccessStory;

    public function updateStory(int $id, array $data): SuccessStory;

    public function deleteStory(int $id): bool;
}
