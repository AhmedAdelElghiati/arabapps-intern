<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Services\User\SuccessStoryService;
use Illuminate\Http\JsonResponse;

class SuccessStoryApiController extends Controller
{
    public function __construct(
        protected SuccessStoryService $successStoryService
    ) {
    }

    /**
     * Display a listing of public success stories for users/mobile apps.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $stories = $this->successStoryService->getTopScored();

        return response()->json([
            'status' => 'success',
            'message' => 'Success stories retrieved successfully.',
            'data' => $stories,
        ], 200);
    }
}
