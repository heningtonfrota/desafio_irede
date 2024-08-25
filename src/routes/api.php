<?php

use App\Http\Controllers\Api\Auth\{
    AuthController,
    UserController,
    CategoryController,
    ProductController
};
use Illuminate\Support\Facades\Route;

Route::get('version', fn() => response()->json(['version' => '1.0.0']));
Route::get('auth/create-token', [AuthController::class, 'createToken']);

Route::middleware('auth:sanctum')->prefix('auth')->group(function() {
    Route::post('products/{product}/save-image', [ProductController::class, 'saveImageToProduct']);
    Route::post('products/{product}/delete-image', [ProductController::class, 'deleteImageToProduct']);

    Route::apiResources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'products' => ProductController::class,
    ]);
});
