<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\QrCodeController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AdminController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::put('/profile/password', [ProfileController::class, 'updatePassword']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Shops
    Route::get('/shops', [ShopController::class, 'index']); // List with search/sort
    Route::post('/shops', [ShopController::class, 'store']); // Create shop
    Route::get('/shops/scan', [ShopController::class, 'scan']); // Scanner endpoint
    Route::get('/shops/{shop}', [ShopController::class, 'show']); // Shop details
    Route::put('/shops/{shop}', [ShopController::class, 'update']); // Update shop
    Route::delete('/shops/{shop}', [ShopController::class, 'destroy']); // Delete shop

    // Subscription/Plans
    Route::get('/plans', [ShopController::class, 'plans']); // View available plans
    Route::post('/shops/{shop}/upgrade', [ShopController::class, 'upgrade']); // Upgrade to premium
    Route::get('/shops/{shop}/payment/success', [ShopController::class, 'paymentSuccess']);
    Route::get('/shops/{shop}/payment/cancel', [ShopController::class, 'paymentCancel']);

    // Visits
    Route::get('/visits', [VisitController::class, 'index']); // Customer history
    Route::post('/visits', [VisitController::class, 'store']); // Record visit

    // QR Code
    Route::get('/my-qr', [QrCodeController::class, 'show']);

    // Admin
    Route::get('/admin', [AdminController::class, 'index']);
    Route::delete('/admin/shops/{shop}', [AdminController::class, 'deleteShop']);
});
