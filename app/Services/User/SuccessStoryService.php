<?php

namespace App\Services\User;

use App\Models\SuccessStory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SuccessStoryService
{
    public function getPaginatedStories(int $perPage = 15): LengthAwarePaginator
    {
        return SuccessStory::orderBy('display_order', 'asc')->where('is_top_scored', true)->paginate($perPage);
    }

    public function getTopScored(): \Illuminate\Database\Eloquent\Collection
    {
        return SuccessStory::orderBy('display_order', 'asc')->where('is_top_scored', true)->get();
    }

}
