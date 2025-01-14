<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\HttpResponses;

class FavouriteController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $favorites = auth()->user()->favourites()->get(['id', 'name', 'price', 'image'])->makeHidden('pivot');
        return $this->successWithDataResponse($favorites);
    }
    public function toggleFavorite($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);
        if ($user->favourites()->where('product_id', $id)->exists()) {
            $user->favourites()->detach($id);
            return $this->successResponse('تمت إزالة المكان من المفضلة');
        } else {
            $user->favourites()->attach($id);
            if (!$product) {
                return $this->failureResponse('المنتج غير موجود');
            }
            return $this->successResponse('تمت إضافة المكان إلي المفضلة');
        }
    }
}
