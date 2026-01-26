<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
Route::get('/', function () {
    return view('welcome');
})->name('home');


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




// Shop & Products
Route::get('/products', function () {
    return view('products');
})->name('products.index');

Route::get('/product/{id}', function ($id) {
    return view('product', compact('id'));
})->name('product.show');

Route::get('/occasions', function () {
    return view('occasions');
})->name('occasions.index');

// Cart & Checkout


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Static Pages
Route::get('/about', function () {
    return view('about');
})->name('about');

// Placeholders for Footer Links
Route::get('/contact', function () {
    // return view('contact'); // Create view if needed
    return redirect()->route('home');
})->name('contact');

Route::get('/privacy', function () {
    // return view('privacy'); // Create view if needed
    return redirect()->route('home');
})->name('privacy');


