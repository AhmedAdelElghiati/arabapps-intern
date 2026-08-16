<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $data)
    {

        $student = $this->userRepository->findByPhone($data['phone']);

        if (!$student || !Hash::check($data['password'], $student->password)) {
            return [
                'message' => 'login failed',
            ];
        }

        $device = $this->userRepository->findDevice($data['device_id']);

        if ($device) {

            $currentStudent = $this->userRepository->findStudent($device->student_id);

            if ($currentStudent && $currentStudent->is_guest==true) {
                $this->userRepository->updateDevice($device,
                 ['student_id' => $student->id
                 ]);
            }
        } else {

            $this->userRepository->createDevice([
                'device_id' => $data['device_id'],
                'student_id' => $student->id
                ]);
        }
        $token = $student->createToken('auth')->plainTextToken;

        return [
            'student' => $student,
            'token' => $token,
        ];
    }

    public function guest(array $data)
    {
        $student = $this->userRepository->create([
            'is_guest' => true,
        ]);
        $this->userRepository->createDevice([
            'device_id' => $data['device_id'],
            'student_id' => $student->id,
        ]);

        return [
            'student' => $student,
        ];
    }
}