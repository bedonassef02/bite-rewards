<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\QrCodeController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Shops
    Route::get('/shops', [ShopController::class, 'index']); // Public/Customer list
    Route::post('/shops', [ShopController::class, 'store']); // Shop Owner create
    Route::get('/shops/{shop}', [ShopController::class, 'show']);
    Route::put('/shops/{shop}', [ShopController::class, 'update']);

    // Visits
    Route::get('/visits', [VisitController::class, 'index']); // Customer history
    Route::post('/visits', [VisitController::class, 'store']); // Shop Owner record visit

    // QR Code
    Route::get('/my-qr', [QrCodeController::class, 'show']);
});
