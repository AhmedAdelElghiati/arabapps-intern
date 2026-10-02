<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class   SuccessStoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {//
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'track' => $this->track,
            'grade' => $this->grade,
            'display_order' => $this->display_order,
            'is_top_scored' => $this->is_top_scored,
            'is_active' => $this->is_active,
            'photo_url' => $this->photo ,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String()
        ];
    }
}
