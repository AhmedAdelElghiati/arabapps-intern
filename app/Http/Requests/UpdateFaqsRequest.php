<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            //
            'question' => 'sometimes|string',
            'answer' => 'sometimes|string',
            'category' => 'nullable|string|new:Enum(\App\Enum\FaqsEnum)',
            'display_order' => 'sometimes|integer',
            'publish_date' => 'nullable|date',
        ];
    }
}
