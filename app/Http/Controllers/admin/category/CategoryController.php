<?php

namespace App\Http\Controllers\admin\category;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        // $category = Category::all();
        // $category = Category::orderBy('id', 'desc')->get();
        $category = Category::latest()->get();
        return view('category.index', compact('category'));
    }

    public function create()
    {
        return view('category.createcategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);



        Category::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Category Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories.index')->with($notification);
    }
    public function show($id)
    {
        $category = Category::FindOrFail($id);

        return view('category.showcategory', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.editcategory', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',

        ]);


        $category->update([
            'name' => $request->name,

        ]);
        $notification = array(
            'message' => 'Category updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories.index')->with($notification);
    }

    public function destroy(Category $category)
    {


        $category->delete();
        $notification = array(
            'message' => 'Category deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('categories.index')->with($notification);
    }
}
