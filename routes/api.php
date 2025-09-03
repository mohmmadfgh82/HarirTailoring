<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\GalleryApiController;

Route::get('/test', fn () => response()->json(['message' => 'API is working!']));

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Public contact form (no auth required)
Route::post('/contact', [App\Http\Controllers\Api\ContactMessageController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/gallery', [GalleryApiController::class, 'index']);
    Route::post('/gallery', [GalleryApiController::class, 'store']);
    Route::delete('/gallery/{id}', [GalleryApiController::class, 'destroy']);

    // Contact Messages Management
    Route::get('/contact-messages', [App\Http\Controllers\Api\ContactMessageController::class, 'index']);
    Route::get('/contact-messages/{id}', [App\Http\Controllers\Api\ContactMessageController::class, 'show']);
    Route::put('/contact-messages/{id}', [App\Http\Controllers\Api\ContactMessageController::class, 'update']);
    Route::delete('/contact-messages/{id}', [App\Http\Controllers\Api\ContactMessageController::class, 'destroy']);
    Route::post('/contact-messages/bulk-action', [App\Http\Controllers\Api\ContactMessageController::class, 'bulkAction']);
    Route::get('/contact-messages-stats', [App\Http\Controllers\Api\ContactMessageController::class, 'stats']);

    // Collections
    Route::apiResource('/collections', CollectionController::class);
});