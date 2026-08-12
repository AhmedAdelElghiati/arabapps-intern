<?php

namespace App\Repositories\Admin;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryRepository
{
    public function all(): Collection
    {
        return Gallery::all();
    }

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

    public function create(array $data): Gallery
    {
        return Gallery::create($data);
    }

    public function update(Gallery $gallery, array $data): bool
    {
        return $gallery->update($data);
    }

    public function delete(Gallery $gallery): bool
    {
        return $gallery->delete();
    }
}
