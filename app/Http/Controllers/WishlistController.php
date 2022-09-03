<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Product;


class WishlistController extends Controller
{
    const TRUE = "true";
    const FALSE= "false";
    public function index(Request $request)
    {
        $user = Auth::user();
       $wishlists = Wishlist::where("user_id",$user->id)->get();

      if ($wishlists) {
        return Helper::setresponse(Self::TRUE, $wishlists, "");
    } else {
        return Helper::setresponse(Self::FALSE, "", "no data found ");
    }
    }
    public function addToWishlist(Request $request,$id)
    {
        $product = Product::find($id);
        $wishlist= new Wishlist();
        $wishlist->user_id=$request->user()->id;
        $wishlist->product_id=$product->id;
        $wishlist->save();
        if ($wishlist) {
            return  Helper::setresponse(Self::TRUE, $wishlist, "");
        } else {
            return  Helper::setresponse(Self::FALSE, "", "no data found ");
        }
    }
public function delete_wishlist($id)
{
    $wishlist = Wishlist::find($id);
    if ($wishlist) {
        $wishlist->delete();
        return response()->json(['message' => 'wishlist deleted successfully'],200);
    } else {
        return response()->json(['message' => 'no wishlist found'],404);
    }
}
}

