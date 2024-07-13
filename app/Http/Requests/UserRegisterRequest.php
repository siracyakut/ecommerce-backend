<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'email' => 'email|required|unique:users',
            'name' => 'string|required|min:3|max:24',
            'surname' => 'string|required|min:3|max:24',
            'password' => 'string|required|confirmed|min:6|max:24',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already in use',
            'email.email' => 'Email is invalid',
            'name.string' => 'Name must be a string',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name must be at most 24 characters',
            'name.required' => 'Name is required',
            'surname.string' => 'Surname must be a string',
            'surname.required' => 'Surname is required',
            'surname.min' => 'Surname must be at least 3 characters',
            'surname.max' => 'Surname must be at most 24 characters',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must be at most 24 characters',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Passwords do not match',
        ];
    }
}
