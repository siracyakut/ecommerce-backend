<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketMessageRequest extends FormRequest
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
            'message' => 'required|string|min:10|max:512',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The ticket ID is required.',
            'id.integer' => 'The ticket ID must be an integer.',
            'id.min' => 'The ticket ID must be at least 1.',
            'message.required' => 'The message is required.',
            'message.min' => 'The message must be at least 10 characters.',
            'message.max' => 'The message must not be greater than 512 characters',
            'message.string' => 'The message must be a string',
        ];
    }
}
