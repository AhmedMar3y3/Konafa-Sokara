<?php

namespace App\Http\Requests\user\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'phone'        => [
                'required',
                'numeric',
                Rule::unique('users', 'phone')->whereNull('deleted_at'),
            ],
            'email'        => [
                'required',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'birth_date'   => 'required|date',
            'password'     => 'required|string',
            'country_code' => 'required|string',
        ];
    }
}
