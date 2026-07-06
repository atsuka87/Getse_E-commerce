<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WarrantyClaimController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\WarrantyClaimController as AdminWarrantyClaimController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\ShippingMethodController as AdminShippingMethodController;
use App\Http\Controllers\Admin\SupplierController as AdminSupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Cart Routes (no auth required for browsing, auth for checkout)
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

/*
|--------------------------------------------------------------------------
| Authenticated Customer Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/payment-proof', [OrderController::class, 'uploadPaymentProof'])->name('orders.upload-proof');
    Route::patch('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');

    // Dashboard redirect
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isPemilik()) {
            return redirect()->route('pemilik.dashboard');
        }
        return redirect()->route('orders.index');
    })->name('dashboard');

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Warranty Claims
    Route::get('/warranty-claims', [WarrantyClaimController::class, 'index'])->name('warranty-claims.index');
    Route::get('/warranty-claims/create', [WarrantyClaimController::class, 'create'])->name('warranty-claims.create');
    Route::post('/warranty-claims', [WarrantyClaimController::class, 'store'])->name('warranty-claims.store');
    Route::get('/warranty-claims/{warrantyClaim}', [WarrantyClaimController::class, 'show'])->name('warranty-claims.show');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', AdminProductController::class);
    Route::delete('product-images/{image}', [AdminProductController::class, 'deleteImage'])->name('product-images.destroy');

    // Categories
    Route::resource('categories', AdminCategoryController::class);

    // Brands
    Route::resource('brands', AdminBrandController::class);

    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('orders/{order}/verify-payment', [AdminOrderController::class, 'verifyPayment'])->name('orders.verify-payment');

    // Reviews
    Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::patch('reviews/{review}/status', [AdminReviewController::class, 'updateStatus'])->name('reviews.update-status');

    // Warranty Claims
    Route::get('warranty-claims', [AdminWarrantyClaimController::class, 'index'])->name('warranty-claims.index');
    Route::get('warranty-claims/{warrantyClaim}', [AdminWarrantyClaimController::class, 'show'])->name('warranty-claims.show');
    Route::patch('warranty-claims/{warrantyClaim}/status', [AdminWarrantyClaimController::class, 'updateStatus'])->name('warranty-claims.update-status');

    // Pengiriman Barang
    Route::resource('shipping-methods', AdminShippingMethodController::class);

    // Supplier
    Route::resource('suppliers', AdminSupplierController::class);

    // Reports
    Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [AdminReportController::class, 'export'])->name('reports.export');

    // Settings
    Route::get('settings/social', [AdminSettingController::class, 'social'])->name('settings.social');
    Route::post('settings/social', [AdminSettingController::class, 'updateSocial'])->name('settings.social.update');
});

/*
|--------------------------------------------------------------------------
| Pemilik Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Pemilik\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/export-laporan', [\App\Http\Controllers\Pemilik\DashboardController::class, 'export'])->name('export-laporan');
});

require __DIR__.'/auth.php';
