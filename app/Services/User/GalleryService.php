<?php

namespace App\Services\User;

use App\Models\Gallery;
use App\Repositories\User\GalleryRepository;
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
}
