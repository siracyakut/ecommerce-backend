<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
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
            'title' => 'string|required|min:3|max:32',
            'message' => 'string|required|min:10|max:512',
            'category' => 'string|required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'message.required' => 'A message is required',
            'category.required' => 'A category is required',

            'title.min' => 'The title must be at least 3 characters',
            'message.min' => 'The message must be at least 10 characters',
            'category.min' => 'The category must be at least 3 characters',

            'title.max' => 'The title must not be greater than 32 characters',
            'message.max' => 'The message must not be greater than 512 characters',
            'category.max' => 'The category must not be greater than 32 characters',

            'title.string' => 'The title must be a string',
            'message.string' => 'The message must be a string',
            'category.string' => 'The category must be a string',
        ];
    }
}
