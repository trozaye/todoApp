<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // Only get categories and tasks for the authenticated user
        $categories = Auth::user()->categories;
        $tasks = Auth::user()->tasks;

        return view('/categories', compact('categories', 'tasks'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(), // Assign the authenticated user ID
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
    public function update(Request $request, Category $categories)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            
        ]);

        // Ensure the category belongs to the authenticated user
        if ($categories->user_id !== Auth::id()) {
            return redirect()->route('categories.index')->with('error', 'Unauthorized action.');
        }

        $categories->update([
            'name' => $request->name,
           
        ]);

        return redirect()->route('categories.index')->with('success', 'Categories updated successfully.');
    }
}
