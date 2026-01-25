<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes (Stubs)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function () {
        // Placeholder for login logic
        return redirect()->route('home');
    });

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function () {
        // Placeholder for register logic
        return redirect()->route('home');
    });
});

Route::post('/logout', function (Request $request) {
    // Placeholder for logout logic
    // Auth::logout();
    // $request->session()->invalidate();
    // $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');


// Shop & Products
Route::get('/products', function () {
    return view('products');
})->name('products.index');

Route::get('/product/{id}', function ($id) {
    return view('product', compact('id'));
})->name('products.show');

Route::get('/occasions', function () {
    return view('occasions');
})->name('occasions.index');

// Cart & Checkout
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

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


