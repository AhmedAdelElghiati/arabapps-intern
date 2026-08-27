<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Enum\TokenAbility;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\GuestRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\OtpRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Student;
use App\Models\User;
use App\Models\Otp;
use App\Models\Device;
use Illuminate\Support\Carbon;
use App\Services\User\AuthService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\GuestMiddleware;

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
            ]
        ]);
    }

    public function verifyOtp(OtpRequest $request)
    {
        $result = $this->userService->verifyOtp($request->validated());

        if (!$result['success']) {
            return $this
                ->setStatusCode(422)
                ->respondWithError($result['message']);
        }

        return $this->setStatusCode(201)->respond([
            'data' => [
                'student' => new UserResource($result['student']),
            ],
            'meta' => [
                'message' => $result['message'],
            ],
        ]);
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
        $student = User::findOrFail(Auth::id());
        $student->currentAccessToken()->delete();
          $access_token = $student->createToken('access-token', [TokenAbility::ACCESS_API->value],
           Carbon::now()->addMinutes(config('sanctum.access_token')))->plainTextToken;
        $refresh_token=$student->createToken('fresh-token',[TokenAbility::ISSUE_ACCESS_TOKEN->value],
        Carbon::now()->addMinutes(config('sanctum.refresh_token')))->plainTextToken;
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
