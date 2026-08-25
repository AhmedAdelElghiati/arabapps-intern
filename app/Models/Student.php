<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Student extends Model
{
    use HasFactory, Notifiable,HasApiTokens;
    protected $fillable=[
        'first_name','last_name','email','phone','phone_verified_at',
        'parent_phone','parent_email','grade','school_name',
        'password','is_guest','student_type','status','created_by'
    ];


    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
