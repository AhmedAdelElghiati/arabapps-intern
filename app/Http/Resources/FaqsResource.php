<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'question'=>$this->question,
            'answer'=>$this->answer,
            'category'=>$this->category,
            'display_order'=>$this->display_order,
            'publish_date'=>$this->publish_date,
            'created_at'=>$this->created_at,
        ];
    }
}
