<?php

namespace App\Http\Requests\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuccessStoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'photo_url'     => ['nullable', 'string', 'max:2048'],
            'grade'         => ['required', 'string', 'max:50'],
            'is_top_scored' => ['boolean'],
            'score'         => ['required', 'numeric', 'min:0'],
            'total_score'   => ['required', 'numeric', 'gte:score'],
            'course_id'     => ['required', 'integer', 'exists:courses,id'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'description'   => ['nullable', 'string'],
        ];
    }
}
