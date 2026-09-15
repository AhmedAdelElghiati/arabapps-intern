<?php
namespace App\Repositories\User;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Models\Otp;
use App\Models\Device;

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
}
