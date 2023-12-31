<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
            ],
            'nivel' => [
                'required'
            ],
            'password' => [
                $this->route()->user ? 'required_with:password_confirmation' : 'required', 'nullable', 'confirmed', 'min:6'
            ],
        ];

        if ( isset($this->request->all()['reset_password']) && $this->request->all()['reset_password']  === 'true')
        {
            $rules = [
                'password' => [
                    $this->route()->user ? 'required_with:password_confirmation' : 'required', 'confirmed', 'min:6'
                ],
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.email' => 'E-mail inválido',
            'name.min' => 'O nome deve possuir no mínimo :min caracteres',
            'nivel.required' => 'Informe o nível de acesso do usuário'
        ];
    }
}
