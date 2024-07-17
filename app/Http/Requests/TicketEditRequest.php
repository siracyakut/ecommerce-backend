<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketEditRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|min:1',
            'status' => 'required|string|max:32',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The ticket ID is required.',
            'id.integer' => 'The ticket ID must be an integer.',
            'id.min' => 'The ticket ID must be at least 1.',
            'status.required' => 'The status is required.',
            'status.max' => 'The status must not be greater than 32 characters',
            'status.string' => 'The status must be a string',
        ];
    }
}
