<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class OrderController extends Controller
{
    //


    public function payOrder(Request $request)
    {
        $basket_count = Basket::where('user_id', '=', Auth::id())->count();

        if ($basket_count == 0) {
            return redirect()->with(['error' => 'سبد خرید شما خالی است.']);
        }

        $get_basket = Basket::where('user_id', '=', Auth::id())->get();

        $amount_price = $request->total_price;

        $order = new Order();
        $order->user_id = $get_basket[0]->user_id;
        $order->total_price = $request->total_price;
        $order->is_paid = 0;
        $order->save();


        foreach ($get_basket as $item)
        {
            $order_details = new OrderDetails();
            $order_details->user_id = $item->user_id;
            $order_details->course_id = $item->course_id;
            $order_details->course_qty = $item->qty;
            $order_details->course_price = $item->price;
            $order_details->order_id = $order->id;
            $order_details->save();
        }

        $invoice = new Invoice();

        $invoice->amount($order->total_price);

        $invoice->detail(['user'=>Auth::user()->name,'amount'=>$order->total_price]);

        $trans = new Transaction();
        $trans->user_id = Auth::id();
        $trans->amount = $amount_price;
        $trans->hash_pay = $invoice->getUuid();
        $trans->order_id = $order->id;
        $trans->is_paid = 0;
        $trans->save();



        return Payment::purchase($invoice,function ($driver,$transactionId) {

        })->pay()->render();


    }

    public function verifyPay(Request $request)
    {
        try {
            $trans = Transaction::where('hash_pay','=',$request->transaction_id)->first();
            $receipt = Payment::amount($trans->total_price)->transactionId($request->transaction_id)->verify();

            // You can show payment referenceId to the user.
            echo $receipt->getReferenceId();

        } catch (InvalidPaymentException $exception) {
            /**
            when payment is not verified, it will throw an exception.
            We can catch the exception to handle invalid payments.
            getMessage method, returns a suitable message that can be used in user interface.
             **/
            echo $exception->getMessage();
        }
    }
}
