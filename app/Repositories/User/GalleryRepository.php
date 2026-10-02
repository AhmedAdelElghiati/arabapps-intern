<?php

namespace App\Repositories\User;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryRepository
{
    public function paginate(?string $query = null , int $perPage = 15) : LengthAwarePaginator
    {
        return Gallery::when($query, function ($q) use ($query) {;
            $q->where('title', 'like', "%{$query}%");
        })->paginate($perPage);
    }

    public function find(int $id): ?Gallery
    {
        return Gallery::find($id);
    }
}
