<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Resources\GalleryResource;
use App\Services\User\GalleryService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;

class GalleryController extends Controller
{
    use ApiResponder;
    public function __construct(
        protected GalleryService $galleryService
    ) {
    }
    public function index(GalleryStoreRequest $request): JsonResponse
    {
        $galleries = $this->galleryService->getPaginatedGalleries($request->query('q'),15);
        return $this->respondResource(GalleryResource::collection($galleries));
    }

    public function show(int $id): JsonResponse
    {
        $gallery = $this->galleryService->getGalleryById($id);
        return $this->respondResource(new GalleryResource($gallery));
    }
}
