<?php

namespace App\Http\Requests\admin\Addition;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdditionRequest extends BaseRequest
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
            'name' => 
            [
                'nullable',
                 'string',
            ],
            'price' => 
            [
                'nullable',
                 'numeric',
            ],
            'category_id' => 
            [
                'nullable',
                 'numeric',
                 Rule::exists('categories', 'id'),
            ],
        ];
    }
}
