<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        
        $categories = Category::when($search, function($query) use ($search) {
            return $query->where('category_name', 'like', '%'.$search.'%');
        })->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['category_name' => 'required']);
        // dd($request->all());
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['category_name' => 'required']);
        // dd($request->all());
        $category->update($request->all());
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

    
}