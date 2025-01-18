<?php

namespace App\Http\Requests\Api\User\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cart_id' => [
                'required',
                Rule::exists('carts', 'id'),
            ],
            'quantity' => [
                'required',
                'numeric',
            ],
            'is_free' => [
                'required',
                'boolean',
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $cart = Cart::find($this->cart_id);
            $product = Product::find($cart->product_id);

            if($this->is_free && ! $product->can_apply_prize
                || $this->is_free && ! $cart->is_free){
                $validator->errors()->add('is_free', 'لا يمكن تحديد المنتج كمنتج مجاني');
            }
        });
    }
}
