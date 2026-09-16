<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlaggedQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->question_id,
            'text' => $this->question->text,
            'options' => ExamOptionResource::collection(
                $this->question->examOptions
            ),
        ];
    }
}
