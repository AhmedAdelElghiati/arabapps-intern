<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string'],
        ];
    }
    public function messages(): array
    {
        return [
            'q.string' => 'The search query must be a string.',
        ];
    }
}
