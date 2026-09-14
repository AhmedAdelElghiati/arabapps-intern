<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseMaterialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'file_url'      => $this->file_url,
            'file_type'     => $this->file_type,
            'file_size'     => $this->file_size,
            'display_order' => $this->display_order,
            'created_at'    => $this->created_at?->toIso8601String(),
        ];
    }
}
