<?php

namespace App\Http\Requests\Exams\Submissions;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SubmitAnswerRequest extends FormRequest
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
            'submission_id' => 'required|integer|exists:exam_submissions,id',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer|exists:questions,id',
            'answers.*.choice_id' => 'required|integer|exists:exam_options,id',
        ];
    }
    public function messages(): array
    {

        return [
            'submission_id.required' => 'Submission ID is required.',
            'submission_id.integer' => 'Submission ID must be an integer.',
            'submission_id.exists' => 'Submission ID must exist in the exam submissions table.',
            'answers.required' => 'Answers are required.',
            'answers.array' => 'Answers must be an array.',
            'answers.*.question_id.required' => 'Question ID is required for each answer.',
            'answers.*.question_id.integer' => 'Question ID must be an integer.',
            'answers.*.question_id.exists' => 'Question ID must exist in the questions table.',
            'answers.*.choice_id.required' => 'Choice ID is required for each answer.',
            'answers.*.choice_id.integer' => 'Choice ID must be an integer.',
            'answers.*.choice_id.exists' => 'Choice ID must exist in the exam options table.',
        ];
    }
}
