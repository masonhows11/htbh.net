<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ShoppingBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingBasketController extends Controller
{
    //


    public function addToBasket(Request $request)
    {
       // return  $request;

       if(ShoppingBasket::where('course_id','=',$request->course_id)
           ->where('user_id','=',$request->user_id)->dosentExists())
       {
          ShoppingBasket::create([
              'course_id'=> $request->course_id,
              'user_id'=> Auth::id(),
              'qty'=>1,
              'price' => $request->course_price,
          ]);
          
       }

    }

    public function getBasket(Request $request)
    {
        return $request;
    }

    public function showBasket()
    {

    }

}
