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
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.nullable' => 'O campo nome é obrigatório.',
            'email.nullable' => 'O campo email é obrigatório.',
            'email.email' => 'O email fornecido não é válido.',
            'email.unique' => 'O email fornecido já existe na base de dados.',
            'password.nullable' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter 6 ou mais caracteres.',
            'password.confirmed' => 'O campo verificação de senha não é compativel.',
        ];
    }
}
