<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GuestRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Student;
use App\Models\User;
use App\Models\Device;
use App\Services\User\UserService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponder;

    protected $userService;

    public function __construct(UserService $userService)
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
                'token' => $result['token'],
                'student' => new UserResource($result['student']),
            ],

            'meta' => [
                'message' => 'login success',
            ],
        ]);
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