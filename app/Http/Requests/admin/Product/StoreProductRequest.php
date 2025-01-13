<?php

namespace App\Http\Requests\admin\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends BaseRequest
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
            'image' => 
            [
                'required',
                'image',
                'mimes:png,jpg,jpeg',
                'max:2048',
            ],

            'description' => 
            [
                'nullable',
                 'string',
            ],
            'recipe' => 
            [
                'nullable',
                 'string',
            ],
            'quantity' => 
            [
                'required',
                 'numeric',
            ],
            'price' => 
            [
                'required',
                 'numeric',
            ],
            'has_discount' => 
            [
                'required',
                 'boolean',
            ],
            'discount_price' => 
            [
                'required_if:has_discount,1',
                 'numeric',
            ],

            'can_apply_prize' => 
            [
                'required',
                 'boolean',
            ],
            'points' => 
            [
                'required_if:can_apply_prize,1',
                 'numeric',
            ],
            'sub_category_id' => 
            [
                'required',
                 'numeric',
                Rule::exists('categories', 'id'),
            ],
            
        ];
    }
}
