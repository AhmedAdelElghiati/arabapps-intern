<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SuccessStoryResource;
use App\Services\User\SuccessStoryService;
use App\Traits\ApiResponder; // 1. Ensure correct import path
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class SuccessStoryApiController extends Controller
{
    use ApiResponder; // 2. Use the trait inside the controller class

    public function __construct(
        protected SuccessStoryService $successStoryService
    ) {}

    public function index(SearchRequest $request)
    {
        // dd(app()->getLocale());
        // dd(lang());
        // app()->setLocale('en');// edit that
        $stories = $this->successStoryService->getPaginatedStories($request->validated('search'));

        return $this->respondResource(
            SuccessStoryResource::collection($stories),
            ['message' => __('pages/top_students.index.success')]
        );
    }
    public function show($id)
    {
        $successStory = $this->successStoryService->findById($id);
        if (!$successStory) {
            return $this->respondNotFound(__('pages/top_students.messages.not_found'));
        }
        return $this->respondResource(
            new SuccessStoryResource($successStory)
        );
    }

}

