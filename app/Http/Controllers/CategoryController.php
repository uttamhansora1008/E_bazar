<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category', compact('category'));
    }
    public function create()
    {
        return view('admin.add-category');
    }
    public function store(Request $request)
    {
      $validatedData = $request->validate([
            'name' => 'required',
           'status' =>'required',
          ]);
        $category = new Category();
        $category->name = $request->input('name');
        $category->status= $request->input('status');
        $category->save();
        return redirect()->route('category.index');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.edit-category', compact('category'));
    }
    public function update(Request $request, $id)
    { 
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->update();
        return redirect()->route('category.index');
    }
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
