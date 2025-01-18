<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\User\Cart\DeleteCartService;
use App\Services\User\Cart\AddUpdateCartService;
use App\Services\User\Cart\GetCartSummaryService;
use App\Services\User\Cart\AddCartAdditionService;
use App\Services\User\Cart\AllowFreeProductService;
use App\Http\Requests\Api\User\Cart\AddToCartRequest;
use App\Http\Requests\Api\User\Cart\DeleteCartRequest;
use App\Http\Requests\Api\User\Cart\UpdateCartRequest;
use App\Services\User\Cart\CheckAvailableQuantityService;
use App\Services\User\Cart\GetUserAvailablePointsService;

class CartController extends Controller
{
    use HttpResponses;
    
    public function addToCart(AddToCartRequest $request)
    {
        $user       = auth()->user();
        $product    = Product::find($request->product_id,['id', 'quantity', 'points']);
        $data       = [];
        
        if(! (new CheckAvailableQuantityService())->checkAvailability($product->quantity, $request->quantity)){
            return $this->failureResponse('المنتج ليس متاح حالياً');
        }

        if($request->is_free){
            $userPoints = (new GetUserAvailablePointsService())->getUserAvaliablePoints($user);

            if((new AllowFreeProductService())->allowFreeProduct($userPoints , $product->points)){
                $data['free_quantity'] = $request->quantity;
                $data['used_points'] = $product->points * $request->quantity;
            }
        }

        try{
            DB::beginTransaction();

            $cart = (new AddUpdateCartService())->addToCart($request->validated() + $data,$user->id,$product->id);

            (new AddCartAdditionService())->addAdditions($cart, $request->additions);

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $this->failureResponse($e->getMessage());
        }

        return $this->successResponse();
    }

    public function updateCart(UpdateCartRequest $request)
    {
        $cart       = Cart::find($request->cart_id);
        $product    = Product::find($cart->product_id);
        $user       = auth()->user();
        $data       = [];

        if(! (new CheckAvailableQuantityService())->checkAvailability($product->quantity, $request->quantity)){
            return ['key' => 'fail', 'msg' => 'المنتج ليس متاح حالياً'];
        }

        if($request->is_free){
            $userPoints = (new GetUserAvailablePointsService())->getUserAvaliablePoints($user);

            if((new AllowFreeProductService())->allowFreeProduct($userPoints , $product->points)){
                $data['free_quantity'] = $request->quantity;
                $data['used_points'] = $product->points * $request->quantity;
            }
        }
        
        (new AddUpdateCartService())->addToCart($request->validated() + $data,$user->id,$product->id);

        return $this->successWithDataResponse((new GetCartSummaryService())->getCartSummary(auth()->user()));
    }

    public function cartSummary()
    {
        $response = (new GetCartSummaryService())->getCartSummary(auth()->user());

        return $this->successWithDataResponse($response);
    }

    public function deleteCart(DeleteCartRequest $request){
        (new DeleteCartService())->deleteCart($request->cart_id);

        return $this->successWithDataResponse((new GetCartSummaryService())->getCartSummary(auth()->user()));
    }
}
