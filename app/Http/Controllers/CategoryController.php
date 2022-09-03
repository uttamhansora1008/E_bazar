<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    const TRUE = "true";
    const FALSE= "false";
    public function index()
    {
        $category = Category::all();

        if ($category) {
            return  Helper::setresponse(Self::TRUE, $category, "false",200);
        } else {
            return  Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }
    }
    public function add_category(Request $request)
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
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
       return  Helper::responseWithMessage(Self::TRUE, $category, 'category added successfully.',200);

    }
    public function update(Request $request, $id)
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
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->status = $request->status;
            $category->update();
            return  Helper::responseWithMessage(Self::TRUE, $category, 'category updated successfully.',200);
        } else {
            return  Helper::responseWithMessage(Self::FALSE, "", "no data found ",404);
        }
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'category deleted successfully'],200);
        } else {
            return response()->json(['message' => 'no category found'],404);
        }
    }

}
