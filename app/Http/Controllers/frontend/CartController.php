<?php

namespace App\Http\Controllers\frontend;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    const TRUE = "true";
    const FALSE= "false";
    public function cart_detail(Request $request)
    {
        $user = auth('api')->user();
        $cart=Cart::where('user_id',$user->id)->pluck('product_id');
        $product = Product::with('image')->whereIn('id', $cart)->select( 'id','name','discount','price')->get();
        if ($product) {
            return  Helper::setresponse(Self::TRUE, $product, "false",200);
        } else {
            return Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }
    public function addTocart(Request $request,$id)
{
    $validator =  Validator::make($request->all(), [
        'quantity' => 'required',
        'size'=>'required',

    ]);
    if ($validator->fails()) {
        return response()->json([
            "flag" => Self::FALSE,
            "message" => $validator->errors()->first(),
            "error" => 'validation_error',
        ], 422);
    }
    $cart=Cart::where(['product_id'=> $id,'user_id' => Auth::user()->id])->first();
    if($cart){
        return  Helper::responseWithMessage(Self::TRUE, $cart, 'cart updated successfully.',200);
    }
    $product = Product::find($id);
    $cart = new Cart();
    $cart->user_id=$request->user()->id;
    $cart->product_id=$product->id;
    $cart->quantity =$request->quantity;
    $cart->size =$request->size;
    $cart->save();
    if ($cart) {
        return  Helper::setresponse(Self::TRUE, $cart, "false",200);
    } else {
        return Helper::setresponse(Self::FALSE, "", "no data found ",404);
    }
}

public function update_cart( Request $request,$id)
{
    $validator =  Validator::make($request->all(), [
        'quantity' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
            "flag" => Self::FALSE,
            "message" => $validator->errors()->first(),
            "error" => 'validation_error',
        ], 422);
    }
    $cart = Cart::find($id);
    if ($cart) {
        $cart->quantity = $request->quantity;
        $cart->update();
        return  Helper::responseWithMessage(Self::TRUE, $cart, 'cart updated successfully.',200);
        } else {
            return  Helper::responseWithMessage(Self::FALSE, "", "no data found ",404);
        }
}
    public function cart_delete(Request $request)
    {
            $cart = Cart::where(['user_id' => Auth::user()->id,'product_id' => $request->product_id])->first();
        if ($cart) {
            $cart->delete();
            return response()->json(['message' => 'cart item deleted successfully'],200);
        } else {
            return response()->json(['message' => 'no cart item found'],404);
        }
    }


public function order(Request $request) {
    $validator =  Validator::make($request->all(), [
        'order_status' => 'required',
        'full_address' => 'required',
        'pincode' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
        'phone' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
            "flag" => Self::FALSE,
            "message" => $validator->errors()->first(),
            "error" => 'validation_error',
        ], 422);
    }
    $order = new Order();
    $order->user_id=$request->user()->id;
    $order->order_status = $request->order_status;
    $order->full_address = $request->full_address;
    $order->pincode = $request->pincode;
    $order->city = $request->city;
    $order->state = $request->state;
    $order->country = $request->country;
    $order->phone= $request->phone;
    $order->save();
    if ($order) {
        return  Helper::setresponse(Self::TRUE, $order, "false",200);
    }

}

}


