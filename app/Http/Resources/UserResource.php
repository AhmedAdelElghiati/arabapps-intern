<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'phone' => $this->phone,
            'grade' => $this->grade,
            'status' => $this->status,
            'type' => $this->student_type,
            'is_guest' => $this->is_guest,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'parent_phone' => $this->parent_phone,
            'parent_email' => $this->parent_email,
            'school_name' => $this->school_name,
        ];
    }
}
