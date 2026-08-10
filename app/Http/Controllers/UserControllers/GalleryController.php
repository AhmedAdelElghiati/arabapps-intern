<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Services\GalleryService;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponder;

class GalleryController extends Controller
{
    use ApiResponder;
    public function __construct(
        protected GalleryService $galleryService
    ) {
    }
    public function index(): JsonResponse
    {
        $galleries = $this->galleryService->getPaginatedGalleries(request()->query('q'),15);
        return $this->respondResource(GalleryResource::collection($galleries));
    }
}
