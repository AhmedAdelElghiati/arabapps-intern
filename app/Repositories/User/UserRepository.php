<?php
namespace App\Repositories\User;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Models\Device;
class UserRepository 
{
        public function findByPhone(string $phone)
    {
        return Student::where('phone', $phone)->first();
    }
    public function findStudent($id){
        return Student::findOrFail($id);
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
        return Device::create($data);
    }

    public function updateDevice($device, array $data)
    {
        return $device->update($data);
    }
}