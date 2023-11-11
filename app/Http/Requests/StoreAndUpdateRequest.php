<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
    }

    public function messages(): array
    {
        return [
            'image.image'   => 'Apenas imagens são permitidas',
            'image.mimes'    => 'Formato de arquivo inválido',
            'image.max'     => 'Tamanho máximo para enviar a imagem :max kilobytes.'
        ];
    }
}
