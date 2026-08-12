<?php

namespace App\Services\Admin;

use App\Models\Gallery;
use App\Repositories\Admin\GalleryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryService
{
    public function __construct(
        protected GalleryRepository $repository
    ) {
    }
    public function getPaginatedGalleries(?string $query = null , int $perPage = 15) : LengthAwarePaginator
    {
        return $this->repository->paginate($query , $perPage);
    }
    public function getGalleryById(int $id): ?Gallery
    {
        return $this->repository->find($id);
    }

    public function createGallery(array $data): Gallery
    {
        if($data['image'] instanceof UploadedFile) {
            $data['image'] = $data['image']->store('galleries');
        }
        return $this->repository->create($data);
    }

    public function updateGallery(Gallery $gallery, array $data): bool
    {
        if($data['image'] instanceof UploadedFile) {
            $data['image'] = $data['image']->store('galleries');
        }
        return $this->repository->update($gallery, $data);
    }
    public function deleteGallery(Gallery $gallery): bool
    {
        return $this->repository->delete($gallery);
    }
}
