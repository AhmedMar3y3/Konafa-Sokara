<?php

namespace App\Http\Requests\Api\User\Cart;

use App\Http\Requests\BaseRequest;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddToCartRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                Rule::exists('products', 'id')->whereNull('deleted_at'),
            ],
            'quantity' => [
                'required',
                'numeric',
            ],
            'additions' => [
                'nullable',
                'array',
            ],
            'additions.*.id' => [
                'required',
                Rule::exists('additions', 'id')->whereNull('deleted_at'),
            ],
            'is_free' => [
                'required',
                'boolean',
            ]
        ];
    }

    public function prepareForValidation()
	{
		return $this->merge([
			'additions' => json_decode($this->additions, true),
		]);
	}

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $product = Product::find($this->product_id);
            $productAdditionsIds    = $product->additions->pluck('id')->toArray();
            $additionIds            = array_column($this->additions ?? [], 'id');
            
            $notAllowedAdditionsIds = array_diff($additionIds, $productAdditionsIds);

            if(! empty($notAllowedAdditionsIds)) {
                $validator->errors()->add('additions', 'الإضافات المحددة غير صحيحة');
            }

            if($this->is_free && ! $product->can_apply_prize){
                $validator->errors()->add('is_free', 'لا يمكن تحديد المنتج كمنتج مجاني');
            }
        });
    }
}
