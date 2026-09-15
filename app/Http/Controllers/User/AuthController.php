<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GuestRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\OtpRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\User\AuthService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponder;

    protected AuthService $userService;

    public function __construct(AuthService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->userService->register($request->validated());

        return $this->respond([
            'meta' => [
                'message'      => $result['message'],
                'requires_otp' => $result['requires_otp'],
                'phone'        => $result['phone'],
            ],
        ]);
    }

    public function verifyOtp(OtpRequest $request)
    {
        $result = $this->userService->verifyOtp($request->validated());

        if (! $result['success']) {
            return $this
                ->setStatusCode(422)
                ->respondWithError($result['message']);
        }

        return $this->setStatusCode(201)->respond([
            'data' => [
                'access_token'  => $result['access_token'],
                'refresh_token' => $result['refresh_token'],
                'student'       => new UserResource($result['student']),
            ],
            'meta' => [
                'message' => $result['message'],
            ],
        ]);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->userService->login($request->validated());

        if (! $result['success']) {
            return $this
                ->setStatusCode(401)
                ->respondWithError($result['message']);
        }

        return $this->respond([
            'data' => [
                'access_token'  => $result['access_token'],
                'refresh_token' => $result['refresh_token'],
                'student'       => new UserResource($result['student']),
            ],
            'meta' => [
                'message' => 'login success',
            ],
        ]);
    }
    public function logout(Request $request){
        $this->userService->logout($request);
        return $this->respondWithSuccess('Successfully logged out');
    }

    public function refresh(Request $request)
    {
        $result = $this->userService->refresh($request->user());
        return $this->respond([
            'data' => [
                'access_token'  => $result['access_token'],
                'refresh_token' => $result['refresh_token'],

            ],
            'meta' => [
                'message' => 'token refreshed',
            ],
        ]);
    }

    public function guest(GuestRequest $request)
    {
        $result = $this->userService->guest($request->validated());

        return $this->setStatusCode(201)->respond([
            'data' => [
                'access_token'  => $result['access_token'],
                'refresh_token' => $result['refresh_token'],
                'student'       => new UserResource($result['student']),
            ],
            'meta' => [
                'message' => 'guest created successfully',
            ],
        ]);
    }
    public function student_profile(Request $request)
    {
        $result = $this->userService->student_profile($request->user('student')->id);

        return $this->respond([
            'data' => [
                'student'       => new UserResource($result['student']),
            ],
            'meta' => [
                'message' => 'student profile retrieved successfully',
            ],
        ]);
    }
}
