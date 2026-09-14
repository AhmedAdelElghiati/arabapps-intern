<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $enrollment = $this->enrollments->first();
        $totalItems = $this->total_items_count ?? 0;
        $completedItems = $this->completed_items_count ?? 0;

        $enrolledAt = $enrollment?->enrolled_at ? Carbon::parse($enrollment->enrolled_at) : null;
        $expiredAt = $enrolledAt ? $enrolledAt->copy()->addDays($this->duration) : null;
        $isExpired = $expiredAt ? Carbon::now()->greaterThan($expiredAt) : false;
        $daysRemaining = ($expiredAt && !$isExpired) ? (int) Carbon::now()->diffInDays($expiredAt) : 0;

        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'image_url'     => $this->image_url,
            'description'   => $this->description,
            'level'         => $this->level,
            'display_order' => $this->display_order,
            'show_at_home'  => $this->show_at_home,
            'is_published'  => $this->is_published,
            'publish_date'  => $this->publish_date,

            // Included conditionally when loaded by the query
            'materials'     => CourseMaterialResource::collection($this->whenLoaded('materials')),
            'lessons'       => LessonResource::collection($this->whenLoaded('lessons')),

            'progress' => [
                'total_items'     => $totalItems,
                'completed_items' => $completedItems,
                'percentage'      => $totalItems > 0 ? round(($completedItems / $totalItems) * 100, 2) : 0,
            ],
            'enrollment' => [
                'access_type'    => $enrollment?->access_type,
                'status'         => $isExpired ? 'expired' : ($enrollment?->status ?? 'none'),
                'enrolled_at'    => $enrolledAt?->toIso8601String(),
                'expired_at'     => $expiredAt?->toIso8601String(),
                'days_remaining' => $daysRemaining,
                'is_expired'     => $isExpired,
            ],
        ];
    }
}
