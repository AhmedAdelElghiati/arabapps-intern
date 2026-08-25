<?php

namespace App\Services\User;

use App\Repositories\User\AuthRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    public function __construct(AuthRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $data)
    {

        $student = $this->userRepository->findByPhone($data['phone']);

        if (!$student || !Hash::check($data['password'], $student->password)) {
            return [
                'success'=>false,
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
            'success'=>true,
            'student' => $student,
            'token' => $token,
        ];
    }

    public function guest(array $data)
    {
        DB::beginTransaction();
        try{
        $student = $this->userRepository->create([
            'is_guest' => true,
        ]);
        $this->userRepository->createDevice([
            'device_id' => $data['device_id'],
            'student_id' => $student->id,
        ]);
        $token=$student->createToken('token')->plainTextToken;
        }
        catch(\Throwable $e){
            DB::rollBack();
        }
        DB::commit();
        return [
            'student' => $student,
            'token'=>$token
        ];
    }
}