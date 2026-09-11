<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamSubmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'exam_id' => $this->exam_id,
            'student_id' => $this->student_id,
            'is_completed' => (bool) $this->is_completed,
            'score' => $this->when($this->is_completed, $this->score),
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
        ];
    }
}
