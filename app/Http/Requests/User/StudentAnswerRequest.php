<?php

namespace App\Http\Requests\User;

use App\Models\ExamSubmission;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $submissionId = $this->route('submissionId');
        $submission = ExamSubmission::where('id', $submissionId)
            ->where('student_id', Auth::guard('student')->id())
            ->first();
        return $submission !== null && !$submission->is_completed;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'choice_id' => ['required', 'integer', 'exists:exam_options,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'choice_id.required' => 'The choice ID is required.',
            'choice_id.integer' => 'The choice ID must be an integer.',
            'choice_id.exists' => 'The specified choice does not exist.',
        ];
    }
}
