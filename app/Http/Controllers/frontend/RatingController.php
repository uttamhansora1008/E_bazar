<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('product_id');
        $product_check = Product::where('id', $product_id)->first();
        if($product_check)
        {
         $existing_rating = Rating::where('user_id', Auth::id())->where('product_id', $product_id)->first();
         if($existing_rating)
         {
             $existing_rating->stars_rated = $stars_rated;
             $existing_rating->update();
         }
         else{
             Rating::create([
                 'user_id' => Auth::id(),
                 'product_id' => $product_id,
                 'stars_rated' => $stars_rated
             ]);
         }
         return redirect()->back()->with('status', "thank you for rating this product");
        }
 }
 public function review(Request $request)
 {
    $name = $request->input('name');
    $email = $request->input('email');
    $subject = $request->input('subject');
    $message = $request->input('message');
    $product_id = $request->input('product_id');
    $product_check = Product::where('id', $product_id)->first();
    if($product_check)
    {
     $existing_review = Review::where('user_id', Auth::id())->where('product_id', $product_id)->first();
     if($existing_review)
     {
         $existing_review->Name = $request->Name;
         $existing_review->Email = $request->Email;
         $existing_review->Subject = $request->Subject;
         $existing_review->Message = $request->Message;
         $existing_review->update();
     }
     else{
         Review::create([
             'user_id' => Auth::id(),
             'product_id' => $product_id,
             'Name' => $name,
             'Email' => $email,
             'Subject' => $subject,
             'Message' => $message,
         ]);
     }
     return redirect()->back()->with('status', "thank you for rating this product");
    }else{
        
    }
 }
}
