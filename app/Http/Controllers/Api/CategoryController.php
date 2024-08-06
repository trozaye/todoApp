<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()->categories; // Get categories for the authenticated user
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 200);
        }

        $category = Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(), // Associate the category with the authenticated user
        ]);

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            return response()->json(["message" => "Unauthorized"], 403);
        }

        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            return response()->json(["message" => "Unauthorized"], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 200);
        }

        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            return response()->json(["message" => "Unauthorized"], 403);
        }

        $category->delete();

        return response()->json(null, 204);
    }
}
