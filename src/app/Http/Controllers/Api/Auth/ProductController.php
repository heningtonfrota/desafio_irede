<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteProductImageRequest;
use App\Http\Requests\SaveProductImageRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['category', 'images'])
            ->when(!empty($request->search),
                function ($query) use ($request) {
                    return $query
                        ->where('name', 'LIKE', "%{$request->search}%")
                        ->orWhere('description', 'LIKE', "%{$request->search}%");
                }
        )
        ->paginate();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $product = Product::create($data);

        if(!empty($data['images'])) {
            $this->saveProductImage($data['images'], $product);
        }

        return new ProductResource($product->with(['category', 'images'])->find($product->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$product = Product::with(['category', 'images'])->find($id)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        if (!$product = Product::with(['category', 'images'])->find($id)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data = $request->validated();

        $product->update($data);

        if(!empty($data['images'])) {
            $this->saveProductImage($data['images'], $product);
        }

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$product = Product::with('images')->find($id)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if(!empty($product->images)) {
            $this->deleteProductImage($product->images->all(), $product);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }

    private function saveProductImage(array $images, Product $product) : void
    {
        foreach ($images as $image) {
            $image_name = $product->id . '-' . Str::slug($product->name) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image_path = $image->storeAs('product_images', $image_name);
            $product->images()->create(['image' => $image_path]);
        }
    }

    private function deleteProductImage(array $images) : void
    {
        foreach ($images as $image) {
            Storage::delete($image->image);
            $image->delete();
        }
    }

    public function saveImageToProduct(SaveProductImageRequest $request, string $id) : ProductResource
    {
        if (!$product = Product::with('images')->find($id)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data = $request->validated();

        if(!empty($data['images'])) {
            $this->saveProductImage($data['images'], $product);
        }

        return new ProductResource($product);
    }

    public function deleteImageToProduct(DeleteProductImageRequest $request, $id) : JsonResponse
    {
        if (!$product = Product::with('images')->find($id)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data = $request->validated();

        if(!empty($data['image_ids'])) {
            $this->deleteProductImage($product->images->whereIn('id', $data['image_ids'])->all(), $product);
        }

        return response()->json(['message' => 'Images deleted']);
    }
}
