<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:30|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'gender' => 'required|in:male,female',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Введите корректный email',
            'email.unique' => 'Этот email уже занят',
            'password.required' => 'Пароль обязателен',
            'password.min' => 'Пароль должен быть не менее 8 символов',
            'password.regex' => 'Пароль должен содержать буквы в верхнем и нижнем регистре и цифры',
            'gender.required' => 'Укажите пол',
            'gender.in' => 'Выберите пол из предложенных вариантов',
        ];
    }
}
