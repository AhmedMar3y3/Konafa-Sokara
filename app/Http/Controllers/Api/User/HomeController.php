<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Home\CategoryResource;
use App\Http\Resources\Home\DiscountedProductResource;
use App\Http\Resources\Home\ProductResource;
use App\Http\Resources\Home\ProductDetailsResource;
use App\Models\Banner;
use App\Traits\HttpResponses;
use App\Models\Category;
use App\Models\Product;

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
        $products = Product::getProductsByCategory($categoryId, $subcategoryId, request()->query('price'));
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

    public function banners(){
        $banners = Banner::get(['id', 'image']);
        return $this->successWithDataResponse($banners);
    }
    public function newestProducts()
    {
        $products = Product::orderBy('created_at', 'desc')->take(1)->get(['id', 'name', 'price', 'image']);
        return $this->successWithDataResponse(ProductResource::collection($products));
    }

    public function offers()
    {
        $products = Product::where('has_discount', 1)->get();
        return $this->successWithDataResponse(DiscountedProductResource::collection($products));
    }

    //TODO: perform the most sold products logic after orders implementation

    public function mostSoldProducts()
    {

    }
}