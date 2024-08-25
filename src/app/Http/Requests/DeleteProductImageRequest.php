<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductImageRequest extends FormRequest
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
            'image_ids' => 'required|array'
        ];
    }

    public function messages() : array
    {
        return [
            'image_ids.required' => 'Ao menos um identificador de imagem deve ser informado.',
            'image_ids.array' => 'O campo imagens deve ser um array.',
        ];
    }
}
