<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Image;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    const TRUE = "true";
    const FALSE= "false";
    public function product()
    {
        $product = Product::with('image')->get();

        if ($product) {
            return  Helper::setresponse(Self::TRUE, $product, "false",200);
        } else {
            return Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }
    public function     add_product(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'subcategory_id' => 'required',
            'quantity'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "flag" => Self::FALSE,
                "message" => $validator->errors()->first(),
                "error" => 'validation_error',
            ], 422);
        }
        $subcategorys= SubCategory::where('id', $request->subcategory_id)->select('name')->first();
        $product = new Product();
        $product->name = $request->name;
        $product->subcategory_id = $request->subcategory_id;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->stock = $request->stock;
        $product->save();
        foreach ($request->file('image') as $image) {
            $filename = rand(3000,10000).'.'.$image->getClientOriginalExtension();
            $image->move(storage_path('app/public/image'), $filename );
                        $image = new Image;
                        $image->image = $filename;
                        $image->product_id = $product->id;
                        $image->save();
                    }
        return response()->json(['subcategory' => $subcategorys,'product' => $product,'image' => $image],200);

    }
    public function update_product(Request $request, $id)
{
    $product = Product::find($id);
    if ($product) {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->stock = $request->stock;
        $product->update();
        foreach ($request->file('image') as $image) {
            $filename = rand(3000,10000).'.'.$image->getClientOriginalExtension();
            $image->move(storage_path('public/image'), $filename );
                        $image = new Image;
                        $image->image = $filename;
                        $image->product_id = $product->id;
                        $image->save();
        }
        return response()->json(['product' => $product,'image' => $image],200);
}
}
public function destory($id)
{
    $product = Product::find($id);
    if ($product) {
        $product->delete();
        return response()->json(['message' => 'product deleted successfully'],200);
    } else {
        return response()->json(['message' => 'no product found'],404);
    }
}
public function image_delete(Request $request, $id)
{
    $image = Image::find($id);
    if ($image) {
        $filename = '/storage/image/' . $image->image;

        if(File::exists($filename)){
            File::delete($filename);
        }
        $image->delete();
        return response()->json(['message' => 'image deleted successfully'],200);
    } else {
        return response()->json(['message' => 'no image found'],404);
    }
}


}

