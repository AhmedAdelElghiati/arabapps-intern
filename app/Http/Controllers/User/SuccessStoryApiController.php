<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessStoryResource;
use App\Services\User\SuccessStoryService;
use App\Traits\ApiResponder; // 1. Ensure correct import path

class SuccessStoryApiController extends Controller
{
    use ApiResponder; // 2. Use the trait inside the controller class

    public function __construct(
        protected SuccessStoryService $successStoryService
    ) {}

    public function index()
    {
        $stories = $this->successStoryService->getPaginatedStories();

        return $this->respondResource(
            SuccessStoryResource::collection($stories),
            ['message' => __('pages/top_students.index.success')]
        );
    }
}

