<?php

namespace App\Http\Requests\admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends BaseRequest
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
            'delivery_price'               => [
                'required',
                'numeric',
                'min:0',
            ],

            'points_per_sar'               => [
                'required',
                'numeric',
                'min:0'
            ],
            'points_per_friend_invitation' => [
                'required',
                'numeric',
                'min:0'
            ],
            'points_per_app_rating'         => [
                'required',
                'numeric',
                'min:0'
            ],
        ];
    }
}
