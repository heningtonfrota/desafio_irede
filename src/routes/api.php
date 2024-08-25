<?php

use App\Http\Controllers\Api\Auth\{
    AuthController,
    UserController
};
use Illuminate\Support\Facades\Route;

Route::get('version', fn() => response()->json(['version' => '1.0.0']));
Route::get('auth/create-token', [AuthController::class, 'createToken']);

Route::middleware('auth:sanctum')->prefix('auth')->group(function() {
    Route::apiResources([
        'users' => UserController::class
    ]);
});
