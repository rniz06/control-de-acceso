<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'usuario' => 'required|min:1|max:45',
            'password' => 'required|min:8',
        ];
    }

    /**
     * Personalizar el mensaje de error segun el campo.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'usuario.required' => 'Usuario requerido.',
            'password.required' => 'Contraseña requerida.',
            'password.min' => 'Contraseña Debe Contener Al Menos 8 Caracteres.',
        ];
    }
}
