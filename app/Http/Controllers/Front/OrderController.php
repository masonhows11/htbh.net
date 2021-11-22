<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //


    public function addOrder(Request  $request)
    {
        $basket_count = Basket::where('user_id','=',Auth::id())->count();

        if ($basket_count == 0)
        {
            return redirect()->with(['error'=>'سبد خرید شما خالی است.']);
        }

        $get_basket = Basket::where('user_id','=',Auth::id())->get();

        foreach ($get_basket as $item){
            $order = new Order();
            $order->user_id = $item->user_id;
            $order->total_price = $request->total_price;
            $order->is_paid = 0;
        }

        
        $order_details = new OrderDetails();


        return $basket_count;
    }
}
