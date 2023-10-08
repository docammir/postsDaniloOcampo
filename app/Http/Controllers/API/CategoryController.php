<?php

namespace App\Http\Controllers\API;


use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, $id)
    {
        $result =  Category::find($id);
        return response()->json($result, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json('success', 204);
    }
}
