<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AssignToDelegateRequest;
use App\Models\Order;
use App\Models\Delegate;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'delegate'])
            ->orderByRaw("CASE WHEN status = 'التجهيز' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        $delegates = Delegate::where('is_active', true)->get();
        
        return view("orders.index", compact("orders", "delegates"));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'delegate', 'items'])
                   ->findOrFail($id);
                   
        return view("orders.show", compact("order"));
    }

    public function assignDelegate(AssignToDelegateRequest $request, Order $order)
    {
        $order->update([
            'delegate_id' => $request->delegate_id,
            'status' => 'الشحن'
        ]);

        return redirect()->back()->with('success', 'تم تعيين المندوب بنجاح');
    }


}
