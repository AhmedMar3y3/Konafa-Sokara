<?php

namespace App\Http\Requests\admin\Addition;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdditionRequest extends BaseRequest
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
                'required',
                 'string',
            ],
            'price' => 
            [
                'required',
                 'numeric',
            ],
            'category_id' => 
            [
                'required',
                 'numeric',
                 Rule::exists('categories', 'id'),
            ],
        ];
    }
}
