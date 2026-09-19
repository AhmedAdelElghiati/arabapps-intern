<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enum\FaqsEnum;
class FaqsRequest extends FormRequest
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
            'question' => ['required', 'array'],
            'question.en' => ['required', 'string'],
            'question.ar' => ['required', 'string'],
            'answer' => ['required', 'array'],
            'answer.en' => ['required', 'string'],
            'answer.ar' => ['required', 'string'],
            'category' => ['nullable', 'array'],
            'category.en' => ['nullable', 'string', Rule::enum(FaqsEnum::class)],
            'category.ar' => ['nullable', 'string'],
            'display_order' => ['required', 'integer'],
            'publish_date' => ['nullable', 'date'],

        ];
    }
}
