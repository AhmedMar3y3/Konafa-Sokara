<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\OrderPayTypes;
use App\Models\Order;
use App\Models\Address;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderItemsService;
use App\Services\Order\OrderPricesService;
use App\Http\Requests\Api\User\Order\StoreOrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use HttpResponses;

    public function store(StoreOrderRequest $request){
        $user = auth()->user();

        if(! $user->carts()->exists()){
            return $this->failureResponse('السله فارغه');
        }
        
        try{
            DB::beginTransaction();
            $addressData = $this->getAddressData($request->address_id);

            $prices = (new OrderPricesService())->getOrderPrices($user);

            $order = Order::create($addressData + $prices +[
                'user_id' => $user->id,
                'pay_type' => $request->pay_type
            ]);

            (new OrderItemsService())->createOrderItems($order,$user);

            $payTypeClass = 'App\Services\OrderPayment\\'.OrderPayTypes::from($request->pay_type)->formattedName().'PaymentService';
            
            $response = (new $payTypeClass())->payOrder($order,$user);

            DB::commit();

            return $this->successWithDataResponse($response);

        }catch(\Exception $e){
            DB::rollBack();
            return $this->failureResponse($e->getMessage());
        }
    }

    private function getAddressData($address_id){
        return Address::find($address_id,['lat','lng','map_desc','title'])->toArray();
    }
}
