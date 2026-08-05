<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuccessStoryRequest extends FormRequest
{
    

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'photo_url'     => ['nullable', 'url', 'max:2048'],
            'grade'         => ['required', 'string', 'max:50'],
            'is_top_scored' => ['nullable', 'boolean'],
            'score'         => ['required', 'numeric', 'min:0'],
            'total_score'   => ['required', 'numeric', 'gte:score'],
            'course_id'     => ['required', 'integer', 'exists:courses,id'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'description'   => ['nullable', 'string'],
        ];
    }
}
