<?php

namespace App\Http\Requests\Exams;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExamIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'student_id' => 'required|integer|exists:students,id',
            'query' => 'nullable|string|max:255',
            'track' => 'nullable|in:ACT,EST,SAT',

        ];
    }
    public function messages(): array
    {
        return [
            'query.string' => 'The query must be a string.',
            'query.max' => 'The query may not be greater than 255 characters.',
            'track.in' => 'The selected track is invalid. Allowed values are ACT, EST, or SAT.',
        ];
    }
}
