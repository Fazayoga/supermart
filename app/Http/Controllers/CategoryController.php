<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category', compact('category'));
    }

    public function header()
    {
        $category = Category::all();
        return view('components.header', compact('category'));
    }

    public function create()
    {
        return view('admin.create_category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category')->with('success','Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.category', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.edit_category', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:category|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')->with('success','Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success','Category deleted successfully');
    }
}
