<?php

namespace App\Repositories\Contracts;

use App\Models\SuccessStory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface SuccessStoryRepositoryInterface
{
    public function getPaginated(int $perPage = 15): LengthAwarePaginator;

    public function getTopScored(): Collection;

    public function findById(int $id): ?SuccessStory;

    public function create(array $data): SuccessStory;

    public function update(SuccessStory $story, array $data): bool;

    public function delete(SuccessStory $story): bool;
}
