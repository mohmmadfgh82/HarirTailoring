<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\WebsiteApiController;

Route::get('/test', fn () => response()->json(['message' => 'API is working!']));

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/gallery', [GalleryApiController::class, 'index']);
    Route::post('/gallery', [GalleryApiController::class, 'store']);
    Route::delete('/gallery/{id}', [GalleryApiController::class, 'destroy']);

    // Products
    Route::apiResource('/products', ProductController::class);

    // Collections
    Route::apiResource('/collections', CollectionController::class);

    // Cart & Checkout
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/checkout', [CartController::class, 'checkout']);

    // Orders
    Route::apiResource('/orders', OrderController::class);

    // User info
    Route::get('/user', [UserController::class, 'profile']);
});
