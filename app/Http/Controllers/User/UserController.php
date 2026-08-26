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

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20|unique:students,phone',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'grade' => 'nullable|string|max:50',
            'school_name' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        // $validatedData['is_guest'] = false;
        $validatedData['student_type'] = 1;
        $validatedData['status'] = 1;
        $student = Student::create($validatedData);

        return response()->json([
            'message' => 'User registered successfully',
            'data' => new UserResource($student),
        ], 201);
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
