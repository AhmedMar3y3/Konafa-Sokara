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
        $product = Product::findOrFail($id);

        $result = auth()->user()->favourites()->toggle($product->id);

        return $this->successWithDataResponse([
            'is_favorite' => empty($result['detached']) ? true : false,
        ]);
    }
}
