<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
            'description' => $this->description,
            'duration' => $this->duration,
            'questions_count' => $this->questions_count,
            'questions' => QuestionResource::collection(
                $this->whenLoaded('questions')
            ),
        ];
    }
}
