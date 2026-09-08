<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->is_free) {
            return [
                'id' => $this->id,
                'description' => $this->description,
                'title' => $this->title,
                'image' => $this->image,
                'created_at' => $this->created_at,
                'is_free' => $this->is_free,
                'level' => $this->level,
                'duration' => $this->duration,

                'lessons_count' => $this->lessons->count(),
                'materials_count' => $this->materials->count(),

                'lessons' => LessonResource::collection($this->lessons),
                'materials' => MaterialResource::collection($this->materials),
            ];
        }
        return [
            'id' => $this->id,
            'description' => $this->description,
            'title' => $this->title,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'is_free' => $this->is_free,
            'level' => $this->level,
            'duration' => $this->duration,

            'lessons_count' => $this->lessons->count(),
            'materials_count' => $this->materials->count(),

            'lessons' => LessonResource::collection($this->lessons),
        ];
    }
}
