<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\AuthController;

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// Admin Login Route
Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');

// Authentication Routes - Restricted
Route::middleware('guest')->group(function () {
    // Only Admin Login should be accessible via specific path if needed, 
    // but standard login routes are removed for public.
    // We map 'login' to admin login implementation or redirect.
    Route::get('/login', function () {
        return redirect()->route('admin.login'); })->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Disable registration
    Route::get('/register', function () {
        return redirect()->route('home'); })->name('register');
    // Route::post('/register', [AuthController::class, 'register']); // Disabled
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




use App\Http\Controllers\ProductController;

// Shop & Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{id}/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/wishlist/toggle', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

Route::get('/occasions', function () {
    return view('occasions');
})->name('occasions.index');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');

// Cart & Checkout


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


// Checkout Routes (Accessible by guests)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::middleware(['auth'])->group(function () {
    // Other auth routes...

    // Order Routes
    Route::get('/my-orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/my-orders/{id}/invoice', [\App\Http\Controllers\OrderController::class, 'invoice'])->name('orders.invoice');

    // Profile Routes
    Route::get('/password', [UserProfileController::class, 'showPasswordForm'])->name('password');
    Route::post('/password', [UserProfileController::class, 'updatePassword'])->name('password.update');
});


// Static Pages
Route::get('/about', function () {
    return view('about');
})->name('about');

// Placeholders for Footer Links
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/privacy', function () {
    // return view('privacy'); // Create view if needed
    return redirect()->route('home');
})->name('privacy');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', \App\Http\Controllers\Admin\Category\CategoryController::class, ['as' => 'admin']);
    Route::resource('products', \App\Http\Controllers\Admin\Product\ProductController::class, ['as' => 'admin']);
    Route::delete('products/image/{id}', [\App\Http\Controllers\Admin\Product\ProductController::class, 'destroyImage'])->name('admin.products.image.destroy');

    // Settings Routes
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('admin.settings.update');

    // Shipping Routes
    Route::get('/shipping', [\App\Http\Controllers\Admin\ShippingController::class, 'index'])->name('admin.shipping.index');
    Route::post('/shipping', [\App\Http\Controllers\Admin\ShippingController::class, 'update'])->name('admin.shipping.update');

    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class, ['as' => 'admin']);
});




// Admin Routes extended
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // ... existing routes ...
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class, ['as' => 'admin'])->only(['index', 'edit', 'update']);
    Route::get('orders/{id}/invoice', [\App\Http\Controllers\Admin\OrderController::class, 'invoice'])->name('admin.orders.invoice');
});






