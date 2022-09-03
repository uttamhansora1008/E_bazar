<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderAddress(Request $request)
    {
        return view('frontend/place-order');
    }
    public function order(Request $request)
    {
        //print_r($_POST);
        //exit;

        $order = new Order();

        $order->user_id = $request->user()->id;

        $order->first_name = $request->input('first_name');
        $order->last_name = $request->input('last_name');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->phone_no = $request->input('phone_no');
        $order->pincode = $request->input('pincode');
        $order->save();
        return redirect('order-confirm');
    }
    public function orderConfirm(Request $request)
    {
        return view('frontend/order-confirm');
    }
}
