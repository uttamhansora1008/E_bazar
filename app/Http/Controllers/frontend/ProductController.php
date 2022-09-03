<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        $product = Product::all();
        return view('frontend.product', compact('product'));
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->subcategory_id  = $request->subcategory;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->discount = $request->input('discount');
        $product->save();
        return redirect()->back();
    }
    
    public function productbycat($id)
    {
        $product = Product::where('subcategory_id', $id)->get();
        return view('frontend.product', compact('product'));
    }
    public function productdetail($product_id)
    {
        $product = Product::find($product_id);
        $image = \App\Models\Image::where('product_id', $product_id)->get();
        $ratings = Rating::where('product_id', $product->id)->get();
        $rating_sum = Rating::where('product_id', $product->id)->sum('stars_rated');
        $user_rating = Rating::where('product_id', $product->id)->where('user_id', Auth::id())->first();
        if ($ratings->count() > 0) {
            $rating_value = $rating_sum / $ratings->count();
        } else {
            $rating_value = 0;
        }
        return view('frontend.product-detail', compact('product', 'image', 'ratings', 'rating_value', 'user_rating'));
    }
    // public function cart()
    // {
    //     $image = Image::all();
    //     $product = product::with('image')->get();
    //     //    return $product[0]->image[0]->image;
    //     return view('frontend.cart', compact('product', 'image'));
    // }
    // public function addToCart(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);
    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //     } else {
    //         $cart[$id] = [
    //             "name" => $product->name,
    //             "quantity" => 1,
    //             "price" => $product->price,
    //             "discount"=>$product->discount,
    //         ];
    //     }
    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success', 'Product add to cart successfully!');
    // }
    // public function update(Request $request)
    // {
    //     if ($request->id && $request->quantity) {
    //         $cart = session()->get('cart');
    //         $cart[$request->id]["quantity"] = $request->quantity;
    //         session()->put('cart', $cart);
    //         session()->flash('success', 'Cart updated successfully');
    //     }
    // }
    // public function remove(Request $request)
    // {
    //     if ($request->id) {
    //         $cart = session()->get('cart');
    //         if (isset($cart[$request->id])) {
    //             unset($cart[$request->id]);
    //             session()->put('cart', $cart);
    //         }
    //         session()->flash('success', 'Product successfully removed!');
    //     }
    // } 
public function update(Request $request,$id)
{
    $cart = Cart::find($id);
    $cart->quantity = $request->input('quantity');
   
    $cart->update();
    return redirect()->route('update.cart');
}
    // public function remove($id) {

    //     Cart::destroy($id);
    //     return redirect("/cart-detail");
    // }
}

