<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'description'  => $this->description,
            'is_free'      => (bool) $this->is_free,
            'publish_date' => $this->publish_date,
            'items'        => LessonItemResource::collection($this->whenLoaded('lessonItems')),
        ];
    }
}
