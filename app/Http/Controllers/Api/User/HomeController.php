<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Home\ProductResource;
use App\Http\Resources\Api\User\Home\CategoryResource;
use App\Http\Resources\Api\User\Home\PrizeProductResource;
use App\Http\Resources\Api\User\Home\ProductDetailsResource;
use App\Http\Resources\Api\User\Home\MostSoldProductResource;
use App\Http\Resources\Api\User\Home\DiscountedProductResource;

class HomeController extends Controller
{
    use HttpResponses;

    public function categories()
    {
        $categories = Category::where('parent_id', null)->with('children')->get();
        return $this->successWithDataResponse(CategoryResource::collection($categories));
    }

    public function products($categoryId, $subcategoryId = null)
    {
        $products = Product::getProductsByCategory($categoryId, $subcategoryId, request()->query('price'), request()->query('search'));
        return $this->successWithDataResponse(ProductResource::collection($products));
    }

    public function showProduct($id)
    {
        $product = Product::with('additions')->find($id);
        if (!$product) {
            return $this->failureResponse('لم يتم العثور على المنتج');
        }
        return $this->successWithDataResponse(new ProductDetailsResource($product));
    }

    public function banners()
    {
        $banners = Banner::get(['id', 'image']);
        return $this->successWithDataResponse($banners);
    }

    public function offers()
    {
        $products = Product::where('has_discount', 1)->get();
        return $this->successWithDataResponse(DiscountedProductResource::collection($products));
    }

    //TODO: perform the most sold products logic after orders implementation

    public function mostSoldProducts()
    {
        $products = Product::withSum('orderItems as total_quantity', 'quantity')
            ->orderBy('total_quantity', 'desc')
            ->get();

        return $this->successWithDataResponse(MostSoldProductResource::collection($products));
    }

    public function prizeProducts()
    {
        $products = Product::where('can_apply_prize', true)->get();
        return $this->successWithDataResponse(PrizeProductResource::collection($products));
    }
}
