<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('version', fn() => response()->json(['version' => '1.0.0']));

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
