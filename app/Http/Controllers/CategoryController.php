<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $user = Auth::user();
        
        $categories = Category::with('user') // Eager load the user relationship
            ->when($search, function($query) use ($search) {
                return $query->where('category_name', 'like', '%'.$search.'%')
                            ->orWhereHas('user', function($q) use ($search) {
                                $q->where('name', 'like', '%'.$search.'%');
                            });
            })
            ->when($user->hasRole('user'), function($query) use ($user) {
                // For regular users, only show their own categories
                return $query->where('user_id', $user->id);
            })
            ->orderBy('updated_at', 'desc') // Optional: sort by most recently updated
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['category_name' => 'required']);
        $user = Auth::user();
        // dd($request->all());
        Category::create([
            'category_name' => $request->category_name,
            'user_id' => $user->id
        ]);
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['category_name' => 'required']);
        $user = Auth::user();
        // dd($request->all());
        $category->update([
            'category_name' => $request->category_name,
            'user_id' => $user->id
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

    
}