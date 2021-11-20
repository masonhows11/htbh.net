<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ShoppingBasket;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingBasketController extends Controller
{
    //


    public function addToBasket(Request $request)
    {
        try {

            if(Course::where('id','=',$request->course_id)->doesntExist())
            {
                return response()->json(['message'=>'دوره مورد نظر وجود ندارد.','status'=>404],404);
            }
            if(ShoppingBasket::where('course_id','=',$request->course_id)
                ->where('user_id','=',Auth::id())->doesntExist())
            {
                ShoppingBasket::create([
                    'course_id'=> $request->course_id,
                    'user_id'=> Auth::id(),
                    'qty'=>1,
                    'price' => $request->course_price,
                ]);

                return response()->json(['message'=>'دوره با موفقیت به سبد خرید اضافه شد.','status'=>200],200);
            }
            if (ShoppingBasket::where('course_id','=',$request->course_id)->where('user_id','=',Auth::id())->where('qty','=',1)->first()){
                return response()->json(['message'=>'این دوره در سبد خرید موجود است.','status'=>202],200);
            }

        }catch (\Exception $ex)
        {
            return Response()->json(['error'=>$ex->getMessage(),'status'=>500],500);
        }


    }

    public function getBasket(Request $request)
    {

        try {
            $current_basket = ShoppingBasket::where('user_id','=',Auth::id())->count();
            return response()->json(['message'=>$current_basket,'status'=>200],200);
        }catch (\Exception $ex)
        {
            return response()->json(['error'=>$ex->getMessage()],500);
        }

    }

    public function showBasket()
    {

        return view('front.basket');

    }

}
