<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ShoppingBasket;
use Illuminate\Http\Request;

class ShoppingBasketController extends Controller
{
    //


    public function addToBasket(Request $request)
    {
       // return  $request;

       if(ShoppingBasket::where('course_id','=',$request->course_id)
           ->where('user_id','=',$request->user_id)->dosentExists())
       {

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
