<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Image;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function cartdetail(Request $request) {
        $user_id=$request->user()->id;
        $cart_list = Cart::where('user_id',$user_id)->get();
        $product_id = Cart::where('user_id',$user_id)->pluck('product_id');
        //  $image=Image::whereIn('product_id',$product_id)->first();

      $product = product::with('image')->get();
        
      return view('frontend.cart', compact('cart_list','product'));  
    }
    public function cartAddsave(Request $request,$product_id) {
        $cart=Cart::where(['product_id'=> $product_id,'user_id' => Auth::user()->id])->first();
        if($cart){
            return response("cart item already exist");
        }
        $cart = new Cart();
        $cart->user_id = $request->user()->id;
        $cart->product_id = $product_id;
        $cart->quantity = 1;
        $cart->save();
     return redirect($_SERVER["HTTP_REFERER"]); 
    }
    public function cartupdateplus($cart_id) {
      
        $cart = cart::find($cart_id);
        $cart->quantity += 1;
        $cart->save();
        return redirect("/cart-detail");
    }

    public function cartupdateminus($cart_id) {
      
        $cart = cart::find($cart_id);
        $cart->quantity -= 1;
        $cart->save();
        return redirect("/cart-detail");
    }
    public function delete($id) {

        Cart::destroy($id);
        return redirect("/cart-detail");
    }
}




