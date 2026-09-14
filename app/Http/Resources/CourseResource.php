<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'title' => $this->title,
            'image' => $this->image ?? $this->image_url,
            'created_at' => $this->created_at,
            'is_free' => (bool) $this->is_free,
            'level' => $this->level,
            'duration' => $this->duration,
            'display_order' => $this->display_order,
            'show_at_home'  => $this->show_at_home,
            'is_published'  => $this->is_published,
            'publish_date'  => $this->publish_date,

            'lessons_count' => $this->whenLoaded('lessons', fn() => $this->lessons->count()),
            'materials_count' => $this->whenLoaded('materials', fn() => $this->materials->count()),

            // Only expose materials if free in the public catalog
            'materials' => $this->when($this->is_free, CourseMaterialResource::collection($this->whenLoaded('materials'))),
            'lessons' => LessonResource::collection($this->whenLoaded('lessons')),
        ];
    }
}
