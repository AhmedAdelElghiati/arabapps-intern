<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enum\FaqsEnum;

class UpdateFaqsRequest extends FormRequest
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
            'question' => ['sometimes', 'array'],
            'question.en' => ['required_with:question', 'string'],
            'question.ar' => ['required_with:question', 'string'],
            'answer' => ['sometimes', 'array'],
            'answer.en' => ['required_with:answer', 'string'],
            'answer.ar' => ['required_with:answer', 'string'],
            'category' => ['sometimes', 'nullable', 'array'],
            'category.en' => ['nullable', 'string', Rule::enum(FaqsEnum::class)],
            'category.ar' => ['nullable', 'string'],
            'display_order' => ['sometimes', 'integer'],
            'publish_date' => ['nullable', 'date'],
        ];
    }
}
