<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;



Route::post('/place-order', [OrderController::class, 'store'])->middleware('auth');
Route::get('/my-orders', [OrderController::class, 'index'])->middleware('auth');

Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::get('/remove-cart/{id}', [CartController::class, 'remove'])->middleware('auth');
Route::get('/', [HomeController::class, 'index']);

// CATEGORY PRODUCTS
Route::get('/category/{id}', [HomeController::class, 'categoryProducts']);

// PRODUCT DETAIL
Route::get('/product/{id}', [HomeController::class, 'productDetail']);
Route::get('/products', [HomeController::class, 'allProduct']);




Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth');
Route::get('/category/{id}', [HomeController::class, 'categoryProducts']);
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->middleware('auth');


// ADMIN ROUTES
Route::middleware(['auth', 'role:order_predictions'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::resource('/admin/products', ProductController::class);
    Route::resource('/admin/categories', CategoryController::class);
    Route::resource('/admin/orders', OrderController::class);
    Route::resource('/admin/users', UserController::class);
});