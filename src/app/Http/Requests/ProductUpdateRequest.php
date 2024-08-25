<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:200',
            'price' => 'nullable|numeric',
            'expiration_date' => 'nullable|date',
            'category_id' => 'nullable|integer',
            'images.*' => 'array|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages() : array
    {
        return [
            'name.nullable' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter até 50 caracteres.',
            'description.nullable' => 'O campo descrição é obrigatório.',
            'description.max' => 'O campo descrição deve ter até 200 caracteres.',
            'price.nullable' => 'O campo preço é obrigatório.',
            'price.numeric' => 'O campo preço deve ser um numero valido.',
            'expiration_date.nullable' => 'O campo data de validade é obrigatório.',
            'expiration_date.date' => 'O campo data de validade deve ser uma data valida.',
            'category_id.nullable' => 'O campo categoria é obrigatório.',
            'category_id.integer' => 'Informe o ID correto da categoria.',
            'images.*.array' => 'O campo imagens deve ser um array.',
            'images.*.image' => 'O campo imagens deve ser uma imagem valida.',
            'images.*.mimes' => 'O campo imagens deve atender as expecificações: jpeg, png, jpg ou gif.',
        ];
    }
}
