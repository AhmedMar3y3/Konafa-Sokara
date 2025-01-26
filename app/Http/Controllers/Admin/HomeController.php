<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Addition;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function dashboard()
    {
        //TODO: Add number of Deliveries instead of subcategories
        $users = User::count();
        $orders = Order::count();
        $products = Product::count();
        $additions = Addition::count();
        $categories = Category::where('parent_id',null)->count();
        $subcategories = Category::where('parent_id', '!=', null)->count();
        $last7DaysUsers = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $userCount = User::whereDate('created_at', $date)->count();
            $last7DaysUsers->put($date, $userCount);
        }

        

        return view('dashboard', compact('products', 'categories', 'subcategories', 'users', 'orders', 'additions', 'last7DaysUsers'));
    }
}
