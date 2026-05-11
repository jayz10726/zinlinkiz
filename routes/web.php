<?php
 
use Illuminate\Support\Facades\Route;
 
// Controllers
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
 
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarouselController;
 
// ═══════════════════════════════════════════════════════
//  PUBLIC / CUSTOMER ROUTES
// ═══════════════════════════════════════════════════════
 
Route::get('/',              [ShopController::class, 'home'])->name('home');
Route::get('/products',      [ShopController::class, 'products'])->name('products');
Route::get('/products/{id}', [ShopController::class, 'show'])->name('product.show');
 
// Cart
Route::get('/cart',              [CartController::class, 'index'])->name('cart');
Route::post('/cart/add',         [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update',      [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}',  [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear',        [CartController::class, 'clear'])->name('cart.clear');
 
// Checkout (guests can checkout too)
Route::get('/checkout',                       [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout',                      [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');
 
// Static pages
Route::get('/about',    [PageController::class, 'about'])->name('about');
Route::get('/contact',  [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSend'])->name('contact.send');
Route::get('/reviews',  [PageController::class, 'reviews'])->name('reviews');
Route::post('/reviews', [PageController::class, 'reviewsStore'])->name('reviews.store');
 
// ═══════════════════════════════════════════════════════
//  BREEZE AUTH ROUTES
// ═══════════════════════════════════════════════════════
require __DIR__ . '/auth.php';
 
// ═══════════════════════════════════════════════════════
//  CUSTOMER DASHBOARD (login required, non-admin)
// ═══════════════════════════════════════════════════════
Route::prefix('my')->name('customer.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard',            [CustomerDashboard::class, 'index'])->name('dashboard');
    Route::get('/orders/{orderNumber}', [CustomerDashboard::class, 'orderDetail'])->name('order');
    Route::post('/profile',             [CustomerDashboard::class, 'updateProfile'])->name('profile.update');
    Route::post('/password',            [CustomerDashboard::class, 'changePassword'])->name('password.change');
});
 
// ═══════════════════════════════════════════════════════
//  ADMIN ROUTES
// ═══════════════════════════════════════════════════════
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin.auth'])->group(function () {
 
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
    // Products
    Route::get('/products',           [ProductController::class, 'index'])->name('products');
    Route::get('/products/create',    [ProductController::class, 'create'])->name('products.create');
    Route::post('/products',          [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}',      [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}',   [ProductController::class, 'destroy'])->name('products.destroy');
 
    // Inventory
    Route::get('/inventory',             [InventoryController::class, 'index'])->name('inventory');
    Route::post('/inventory/bulk',       [InventoryController::class, 'bulkUpdate'])->name('inventory.bulk');
    Route::post('/inventory/{id}/stock', [InventoryController::class, 'updateStock'])->name('inventory.stock');
 
    // Orders
    Route::get('/orders',              [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}',         [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
 
    // Reviews
    Route::get('/reviews',                  [ReviewController::class, 'index'])->name('reviews');
    Route::post('/reviews',                 [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{id}/approve',    [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{id}/reject',     [ReviewController::class, 'reject'])->name('reviews.reject');
    Route::post('/reviews/{id}/feature',    [ReviewController::class, 'toggleFeatured'])->name('reviews.feature');
    Route::delete('/reviews/{id}',          [ReviewController::class, 'destroy'])->name('reviews.destroy');
 
    // Team
    Route::get('/team',          [TeamController::class, 'index'])->name('team');
    Route::post('/team',         [TeamController::class, 'store'])->name('team.store');
    Route::put('/team/{id}',     [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{id}',  [TeamController::class, 'destroy'])->name('team.destroy');
 
    // Carousel
    Route::get('/carousel',               [CarouselController::class, 'index'])->name('carousel');
    Route::post('/carousel',              [CarouselController::class, 'store'])->name('carousel.store');
    Route::post('/carousel/reorder',      [CarouselController::class, 'reorder'])->name('carousel.reorder');
    Route::put('/carousel/{id}',          [CarouselController::class, 'update'])->name('carousel.update');
    Route::post('/carousel/{id}/toggle',  [CarouselController::class, 'toggleActive'])->name('carousel.toggle');
    Route::delete('/carousel/{id}',       [CarouselController::class, 'destroy'])->name('carousel.destroy');
 
    // Admin management (super_admin only)
    Route::get('/admins',                      [AdminController::class, 'index'])->name('admins');
    Route::post('/admins',                     [AdminController::class, 'store'])->name('admins.store');
    Route::put('/admins/{id}',                 [AdminController::class, 'update'])->name('admins.update');
    Route::post('/admins/{id}/reset-password', [AdminController::class, 'resetPassword'])->name('admins.reset-password');
    Route::post('/admins/{id}/toggle',         [AdminController::class, 'toggleActive'])->name('admins.toggle');
    Route::delete('/admins/{id}',              [AdminController::class, 'destroy'])->name('admins.destroy');
 
    // Own password change
    Route::post('/my-password', [AdminController::class, 'changeOwnPassword'])->name('my.password');
});