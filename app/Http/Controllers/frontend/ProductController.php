<?php

namespace App\Http\Controllers\frontend;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    const TRUE = "true";
    const FALSE= "false";
    public function  product_by_cat($id)
    {
        $product = Product::where('subcategory_id', $id)->with('image')->get();
        if ($product) {
            return Helper::setresponse(Self::TRUE, $product, "",200);
        } else {
            return Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }
    public function product_detail($id)
    {
        $product = Product::find($id);
        $product = Product::with('image')->whereIn('id', $product)->get();
        if ($product) {
            return  Helper::setresponse(Self::TRUE, $product, "",200);
        } else {
            return  Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }
    function search($name)
    {
        $result = Product::where('name', 'LIKE', '%'. $name. '%')->with('image')->get();
        if (count($result)) {
            return  Helper::setresponse(Self::TRUE, $result, "",200);
        } else {
            return  Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }

    public function rating(Request $request,  $id)
    {
        $validator =  Validator::make($request->all(), [
            'rating' => 'required',
            'reviews' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "flag" => Self::FALSE,
                "message" => $validator->errors()->first(),
                "error" => 'validation_error',
            ], 422);
        }
        $product = Product::find($id);
        $rating= new Rating();
        $rating->user_id=$request->user()->id;
        $rating->product_id=$product->id;
        $rating->rating=$request->rating;
        $rating->reviews=$request->reviews;
        $rating->save();
        if($rating) {
            return  Helper::setresponse(Self::TRUE, $rating, "",200);
        } else {
            return  Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }

}
