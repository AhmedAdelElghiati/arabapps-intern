<?php

namespace App\Repositories\User;

use App\Models\SuccessStory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuccessStoryRepository
{

    public function getAllSuccessStory(?string $search = null)
    {
        // dd($search);
        // echo $search;
        $query = SuccessStory::query();
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->paginate(10)->withQueryString();
    }
    public function getSuccessStoryById($id)
    {
        return  SuccessStory::find($id);
    }
}
