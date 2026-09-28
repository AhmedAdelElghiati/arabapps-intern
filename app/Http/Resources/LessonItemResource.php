<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $completion = $this->relationLoaded('completedItems')
        ? $this->completedItems->first()
        : null;

        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'type'          => $this->type,
            'display_order' => $this->display_order,
            'url'           => $this->url,
            'exam_id'       => $this->exam_id,
            'is_free'       => (bool) $this->is_free,
            'publish_date'  => $this->publish_date,
            'is_completed'  => $this->relationLoaded('completedItems') && $this->completedItems->isNotEmpty(),
            'completed_at'  => $completion?->completed_at?->toIso8601String(),
        ];
    }
}
