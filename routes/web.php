<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Shops
    Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
    Route::get('/shops/create', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
    Route::get('/shops/{shop}/edit', [ShopController::class, 'edit'])->name('shops.edit');
    Route::put('/shops/{shop}', [ShopController::class, 'update'])->name('shops.update');
    Route::get('/shops/scan', [ShopController::class, 'scan'])->name('shops.scan'); // Specific route before show
    Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');
    
    // Subscription
    Route::get('/plans', [ShopController::class, 'plans'])->name('shops.plans');
    Route::post('/shops/{shop}/upgrade', [ShopController::class, 'upgrade'])->name('shops.upgrade');
    Route::get('/shops/{shop}/payment/success', [ShopController::class, 'paymentSuccess'])->name('shops.payment.success');
    Route::get('/shops/{shop}/payment/cancel', [ShopController::class, 'paymentCancel'])->name('shops.payment.cancel');

    // Visits
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');

    // Customer
    Route::get('/my-qr', function () {
        return view('customer.qr');
    })->name('customer.qr');

    // Admin
    Route::get('/admin', [\App\Http\Controllers\Web\AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/shops/{shop}', [\App\Http\Controllers\Web\AdminController::class, 'deleteShop'])->name('admin.shops.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Fallback route for 404 errors
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
