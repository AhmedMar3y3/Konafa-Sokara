<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class register extends FormRequest
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
            'first_name'   => 'required|string',
            'last_name'    => 'required|string',
            'phone'        => 'required|string|unique:users,phone',
            'email'        => 'required|email|unique:users,email',
            'birth_date'   => 'required|date',
            'password'     => 'required|string',
            'country_code' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'The phone has already been taken.',
            'email.unique' => 'The email has already been taken.',
        ];
    }
}
