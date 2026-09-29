<?php
namespace App\Repositories\User;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Models\Otp;
use App\Models\Device;
use App\Models\ResetPassword;
use Laravel\Sanctum\PersonalAccessToken;

class AuthRepository
{
    // app/Repositories/User/AuthRepository.php

public function createOrUpdateOtp(array $data, string $otp, string $deviceId,string $phone): Otp
{
    return Otp::updateOrCreate(
        ['phone' => $phone],
        [
            'device_id'  => $deviceId,
            'phone'      => $phone,
            'otp_code'   => $otp,
            'data'       => $data,
            'expires_at' => now()->addMinutes(10),
        ]
    );
}

    public function findLatestOtpByPhone(string $phone): ?Otp
    {
        return Otp::where('phone', $phone)->latest()->first();
    }

    public function createStudent(array $data): Student
    {
        return Student::create($data);
    }

    public function linkDeviceToStudent(string $deviceId, int $studentId): void
    {
        Device::updateOrCreate(
            ['device_id' => $deviceId],
            ['student_id' => $studentId]
        );
    }
    public function findStudentById(int $studentId): ?Student
    {
        return Student::find($studentId);
    }

    public function deleteOtp(Otp $otp): void
    {
        $otp->delete();
    }
    public function findByPhone(string $phone)
    {
        return Student::where('phone', $phone)->first();
    }

    public function create(array $data)
    {
        return Student::create($data);
    }

    public function findDevice(string $deviceId)
    {
        return Device::where('device_id', $deviceId)->first();
    }

    public function createDevice(array $data)
    {
        return Device::createOrUpdate($data);
    }

    public function updateDevice($device, array $data)
    {
        return $device->update($data);
    }
    public function deleteTokens($request){
        $request->user()->currentAccessToken()->delete();
    }

    public function findByPhoneForReset(string $phone)
    {
        return ResetPassword::where('phone', $phone)->first();
    }
    public function createResetToken(string $phone, string $token, int $expiresInMinutes = 15)
    {
        ResetPassword::
            where('phone', $phone)
            ->update([
                'reset_token' => Hash::make($token),
                'expires_at' => now()->addMinutes($expiresInMinutes),
            ]);
    }

    public function updatePasswordByPhone(string $phone, string $newPassword)
    {
        $user = Student::where('phone', $phone)->first();

        if ($user) {
            $user->forceFill([
                'password' => Hash::make($newPassword),
            ])->save();
        }
    }

    public function deleteByPhone(string $phone)
    {
        ResetPassword::where('phone', $phone)->delete();
    }
}
