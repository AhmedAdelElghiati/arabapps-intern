<?php

namespace App\Services;

use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryService
{
    public function __construct(
        protected GalleryRepository $repository
    ) {
    }
    public function getAllGalleries(): Collection
    {
        return $this->repository->all();
    }
    public function getPaginatedGalleries(int $perPage = 15) : LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
    public function getGalleryById(int $id): ?Gallery
    {
        return $this->repository->find($id);
    }

    public function createGallery(array $data): Gallery
    {
        return $this->repository->create($data);
    }

    public function updateGallery(Gallery $gallery, array $data): bool
    {
        return $this->repository->update($gallery, $data);
    }
    public function deleteGallery(Gallery $gallery): bool
    {
        return $this->repository->delete($gallery);
    }
}
