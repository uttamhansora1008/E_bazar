<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    const TRUE = "true";
    const FALSE= "false";
    public function subcategory($id)
    {

        $subcategory = SubCategory::where('category_id', $id)->get();

        if ($subcategory) {
            return  Helper::setresponse(Self::TRUE, $subcategory, "",200);
        } else {
            return  Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }
    public function add_subcategory(Request $request)
    {
            $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "flag" => Self::FALSE,
                "message" => $validator->errors()->first(),
                "error" => 'validation_error',
            ], 422);
        }

    $categorys= Category::where('id', $request->category_id)->select('name')->first();

    $subcategory = new SubCategory();
    $subcategory->category_id =$request->category_id;
    $subcategory->name = $request->name;
    $subcategory->status = $request->status;
    foreach ($request->file('image') as $image) {
        $filename = rand(3000,10000).'.'.$image->getClientOriginalExtension();
        $image_path = $image->move(storage_path("images"), $filename );
                    $subcategory->image = $filename;
                    $subcategory->save();
                }

    return response()->json([ 'category' => $categorys,'subcategory' => $subcategory,'message' => 'subcategory added suceesfully'],200);
}
public function update_subcategory(Request $request, $id)
{
    $validator =  Validator::make($request->all(), [
        'name' => 'required',
        'status' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
            "flag" => Self::FALSE,
            "message" => $validator->errors()->first(),
            "error" => 'validation_error',
        ], 422);
    }
    $subcategory = SubCategory::find($id);
    if ($subcategory) {
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;
        $subcategory->update();
        return  Helper::responseWithMessage(Self::TRUE, $subcategory, 'subcategory updated successfully.',200);
        } else {
            return  Helper::responseWithMessage(Self::FALSE, "", "no data found ",404);
        }
}
public function subcategory_delete($id)
{
    $subcategory = SubCategory::find($id);
    if ($subcategory) {
        $subcategory->delete();
        return response()->json(['message' => 'subcategory deleted successfully'],200);
    } else {
        return response()->json(['message' => 'no subcategory found'],404);
    }
}

    }

