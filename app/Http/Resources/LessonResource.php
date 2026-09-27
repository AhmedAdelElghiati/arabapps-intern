<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $isLocked = !$this->is_free;

        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'description'  => $this->when(!$isLocked, $this->description),
            'is_free'      => (bool) $this->is_free,
            'is_locked'    => $isLocked,
            'publish_date' => $this->publish_date,
            'items'        => $this->when(!$isLocked, LessonItemResource::collection($this->whenLoaded('lessonItems'))),
        ];
    }
}
