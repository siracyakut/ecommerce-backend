<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'email|unique:users',
            'telephone' => 'string',
            'newPass' => 'string|required_with:newPassConfirm|same:newPassConfirm',
            'newPassConfirm' => 'string',
            'passForConfirm' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Email is invalid',
            'telephone.string' => 'Telephone must be string',
            'newPass.string' => 'Password must be string',
            'newPassConfirm.string' => 'Password must be string',
            'passForConfirm.string' => 'Password must be string',
        ];
    }
}
