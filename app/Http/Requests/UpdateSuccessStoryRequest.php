<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSuccessStoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            return [
            'name'          => ['sometimes', 'string', 'max:255'],
            'photo_url'     => ['nullable', 'url', 'max:2048'],
            'grade'         => ['sometimes', 'string', 'max:50'],
            'is_top_scored' => ['boolean'],
            'score'         => ['sometimes', 'numeric', 'min:0'],
            'total_score'   => ['sometimes', 'numeric', 'gte:score'],
            'course_id'     => ['sometimes', 'integer', 'exists:courses,id'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'description'   => ['nullable', 'string'],
        ];
    }
}
