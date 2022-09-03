<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    $image = Image::all();
        $subcategory = product::all();
        $product = product::with('image')->get();
//  return @$product[2]->image[0]->image;
        return view('admin.product', compact('product', 'subcategory','image'));
    }
    public function create()
    {
        $image = Image::all();
        $subcategory = Subcategory::all();
        return view('admin.add-product', compact('subcategory'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'discount' => 'required',
            'image.*' => 'required',
]);
        $product = new Product();
        $product->subcategory_id  = $request->subcategory;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->discount = $request->input('discount');
        $product->save();
        foreach ($request->file('image') as $image) {     
            $filename = rand(3000, 10000).'_' .time(). '.' . $image->getClientOriginalExtension();
            $image = $image->move(storage_path('app/public/image'), $filename);
            $image = new Image;
            $image->image = $filename;
            $image->product_id = $product->id;
            $image->save();
        }
        return redirect()->route('product.index');
    }
    public function edit($id)
    {
        $subcategory = Subcategory::all();
        $product = Product::find($id);
        return view('admin.edit-product', compact('product', 'subcategory'));
    }
    public function update(Request $request, $id)
    {
       
        $product = Product::find($id);
        $imagefind = Image::where("product_id",$id)->first();
        if(!$imagefind){
            $validated = $request->validate([
                'image' => 'required',
            ]);
        }
        $product->subcategory_id  = $request->subcategory;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->discount = $request->input('discount');
        $product->update();
        if($request->file("image")!=null){

        
        foreach ($request->file('image') as $image) {
            $filename =  rand(3000, 10000).'_' . time() . '.' . $image->getClientOriginalExtension();
            $image = $image->move(storage_path('app/public/image'), $filename);
            $image = new Image;
            $image->image =$filename;
            $image->product_id = $product->id;
            $image->save();
        }
     }
        return redirect()->route('product.index');
 }
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }
    public function imagedelete($id)
    {
        $image = Image::find($id);
        if (File_exists("/storage/image/" . $image)) {
            unlink("/storage/image/" . $image);
        }
     $image=Image::find($id)->delete();
        return redirect()->back();
    } 
}


    