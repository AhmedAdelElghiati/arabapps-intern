<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GuestRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Student;
use App\Models\User;
use App\Models\Device;
use App\Services\User\AuthService;
use App\Traits\ApiResponder;


class AuthController extends Controller
{
    use ApiResponder;

    protected $userService;

    public function __construct(AuthService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->userService->login(
            $request->validated()
        );


        if (!$result['success']) {
            return $this
                ->setStatusCode(401)
                ->respondWithError($result['message']);
        }

        return $this->respond([
            'data' => [
                'access_token' => $result['access_token'],
                'refresh_token' => $result['refresh_token'],
                'student' => new UserResource($result['student']),
            ],

            'meta' => [
                'message' => 'login success',
            ],
        ]);
    }
    public function refresh()
    {
        // return ;
        return response()->json(['message' => 'ok']);
        // return 'OK';
    }

    public function guest(GuestRequest $request)
    {
        $result = $this->userService->guest(
            $request->validated()
        );

        return $this->respond([
            'data' => [
                'student' => new UserResource($result['student']),
            ],

            'meta' => [
                'message' => 'guest created successfully',
            ],
        ]);

    }


}