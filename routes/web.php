<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;




Route::post('/place-order', [OrderController::class, 'store'])->middleware('auth');
Route::get('/cart/increase/{id}', [CartController::class, 'increase']);
Route::get('/cart/decrease/{id}', [CartController::class, 'decrease']);
Route::post('/cart/update/{id}', [CartController::class, 'updateQty']);
Route::get('/my-orders', [OrderController::class, 'index'])->middleware('auth');
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::post('/reorder/{id}', [OrderController::class, 'reorder']);
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::get('/remove-cart/{id}', [CartController::class, 'remove'])->middleware('auth');
Route::get('/', [HomeController::class, 'index']);
Route::get('/search-products', [ProductController::class, 'search']);

// CATEGORY PRODUCTS
Route::get('/category/{id}', [HomeController::class, 'categoryProducts']);

// PRODUCT DETAIL
Route::get('/product/{id}', [HomeController::class, 'productDetail']);
Route::get('/products', [HomeController::class, 'allProduct']);


Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::post('/cart/add-multiple', [CartController::class, 'addMultiple'])->name('cart.add.multiple');
Route::get('/order-products', [OrderController::class, 'allOrderProducts']);
Route::post('/order/reorder-submit', [OrderController::class, 'reorderSubmit'])->name('order.reorder.submit');
Route::get('/register', fn() => view('auth.register'));
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth');
Route::get('/category/{id}', [HomeController::class, 'categoryProducts']);
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->middleware('auth');

Route::get('/inventory', function () {
    return view('inventory.index');
})->name('inventory');

Route::get('/sales', function () {
    return view('sales.index');
})->name('sales');

Route::get('/delivery', function () {
    return view('delivery.index');
})->name('delivery');

Route::get('/admin-dashboard', function () {
    return view('adminLayout.index');
})->name('admin-dashboard');

// ADMIN ROUTES
Route::middleware(['auth', 'role:business_owner,sale_rep,inventory_manager,delivery_team'])->group(function () {

   
    //  Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
     Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});

    Route::put('/admin/orders/{id}/status', [AdminController::class, 'updateStatus']);
    Route::put('/admin/orders/{id}/cancel', [OrderController::class, 'cancelOrder']);
Route::delete('/admin/orders/{id}', [AdminController::class, 'destroyOrder']);

Route::get('/admin/orders', [AdminController::class, 'orders']);
Route::get('/admin/orders/{id}/view', [AdminController::class, 'orderView']);

    Route::resource('/admin/products', ProductController::class);
    Route::resource('/admin/categories', CategoryController::class);
    Route::get('/admin/users/create', [AdminController::class, 'createUser']);
Route::post('/admin/users/store', [AdminController::class, 'storeUser']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);
});