<?php

namespace App\Services\User;

use App\Enum\TokenAbility;
use App\Repositories\User\AuthRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthService
{
    protected AuthRepository $userRepository;

    public function __construct(AuthRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        $otp = (string) random_int(100000, 999999);

        $otp = "123456";
        $this->userRepository->createOrUpdateOtp($data, $otp, $data['device_id'], $data['phone']);
        // Send SMS with the raw $otp code here

        return [
            'success' => true,
            'message' => 'Registration initiated. OTP sent successfully.',
            'requires_otp' => true,
            'phone' => $data['phone'],
        ];
    }

    public function verifyOtp(array $data): array
    {
        $pending = $this->userRepository->findLatestOtpByPhone($data['phone']);

        if (
            !$pending
            || !hash_equals((string) $pending->otp_code, (string) $data['otp_code'])
            || now()->greaterThan($pending->expires_at)
        ) {
            return [
                'success' => false,
                'message' => 'Invalid OTP code or OTP has expired.',
            ];
        }

        return DB::transaction(function () use ($pending) {
            $studentData = $pending->data;
            $studentData['is_guest'] = false;
            $studentData['status'] = 'Active';
            $studentData['phone_verified_at'] = now();

            $student = $this->userRepository->createStudent($studentData);

            if (!empty($pending->device_id)) {
                $this->userRepository->linkDeviceToStudent($pending->device_id, $student->id);
            }

            $this->userRepository->deleteOtp($pending);

            return array_merge(
                [
                    'success' => true,
                    'student' => $student,
                    'message' => 'Account verified and created successfully.',
                ],
                $this->issueTokens($student)
            );
        });

    }
    public function resetPassword(string $phone, string $resetToken, string $newPassword): void
    {

        $record = $this->userRepository->findByPhoneForReset($phone);

        if (!$record || !$record->reset_token || $record->isExpired()) {
            throw ValidationException::withMessages([
                'reset_token' => ['The session has expired. Please request a new OTP.'],
            ]);
        }

        if (!Hash::check($resetToken, $record->reset_token)) {
            throw ValidationException::withMessages([
                'reset_token' => ['Invalid authorization token.'],
            ]);
        }

        $this->userRepository->updatePasswordByPhone($phone, $newPassword);
        $this->userRepository->deleteByPhone($phone);
    }
    public function login(array $data): array
    {
        $student = $this->userRepository->findByPhone($data['phone']);

        if (!$student || !Hash::check($data['password'], $student->password)) {
            return [
                'success' => false,
                'message' => 'login failed',
            ];
        }

        if ($student->status === 'Blocked') {
            return [
                'success' => false,
                'message' => 'Your account has been blocked.',
            ];
        }

        $device = $this->userRepository->findDevice($data['device_id']);

        if ($device) {
            $this->userRepository->updateDevice($device, ['student_id' => $student->id]);
        } else {
            $this->userRepository->createDevice([
                'device_id' => $data['device_id'],
                'student_id' => $student->id,
            ]);
        }

        return array_merge(
            [
                'success' => true,
                'student' => $student,
            ],
            $this->issueTokens($student)
        );
    }
    public function logout($request){
        $this->userRepository->deleteTokens($request);
    }
    public function student_profile($id): array
    {

        $student = $this->userRepository->findStudentById($id);



        return [
            'success' => true,
            'student' => $student,
        ];
    }
    public function guest(array $data): array
    {
        $device_id = $this->userRepository->findDevice($data['device_id']);
        if ($device_id && $device_id->student && $device_id->student->is_guest) {

            return [
                'success' => true,
                'student' => $device_id->student,

            ];
        } else {
            return DB::transaction(function () use ($data) {
                $student = $this->userRepository->create([
                    'is_guest' => true,
                ]);


                $this->userRepository->linkDeviceToStudent($data['device_id'], $student->id);

                return array_merge(
                    ['student' => $student],
                    $this->issueTokens($student)
                );
            });
        }
    }

    public function refresh($student): array
    {
        $student->currentAccessToken()->delete();

        return $this->issueTokens($student);
    }

    /**
     * Issue a fresh access/refresh token pair for the given student.
     */
    private function issueTokens($student): array
    {
        return [
            'access_token' => $student->createToken(
                'access-token',
                [TokenAbility::ACCESS_API->value],
                Carbon::now()->addMinutes((int) config('sanctum.access_token'))
            )->plainTextToken,
            'refresh_token' => $student->createToken(
                'refresh-token',
                [TokenAbility::ISSUE_ACCESS_TOKEN->value],
                Carbon::now()->addMinutes((int) config('sanctum.refresh_token'))
            )->plainTextToken,
        ];
    }
}
