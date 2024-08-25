<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return response()->json(['categories' => CategoryResource::collection($categories)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();

        $category = Category::create($data);

        return response()->json(['category' => new CategoryResource($category)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$category = Category::find($id)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json(['category' => new CategoryResource($category)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        if (!$category = Category::find($id)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $data = $request->validated();

        $category->update($data);

        return response()->json(['category' => new CategoryResource($category)], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$category = Category::find($id)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted'], 200);
    }
}
