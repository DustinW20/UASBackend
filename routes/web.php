<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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




Route::get("/" , function(){
    return redirect('/home');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');


Route::get("login", function () {
    return view('login');
})->name('login');


Route::get("register", function () {
    return view('register');
})->name('register');


Route::post("/register", [AuthController::class, "register"])->name('register.store');
Route::post("/login", [AuthController::class, "login"])->name('login.store');
Route::get("/logout", [AuthController::class, "logout"])->name('logout');









Route::middleware(['auth'])->group(function () {
    Route::get("/admin", [AdminController::class, "index"])->name('admin.index');
    Route::get("/admin/menu", [AdminController::class, "menu"])->name('admin.menu');
    Route::get("/admin/order", [AdminController::class, "order"])->name('admin.order');
    Route::put("/admin/order/{cartItem}", [AdminController::class, "orderUpdate"])->name('admin.order.update');
    Route::delete("/admin/order/{cartItem}", [AdminController::class, "orderDestroy"])->name('admin.order.destroy');

    Route::get("/admin/riwayat", [AdminController::class, "riwayat"])->name('admin.riwayat');

    Route::get("/admin/profile", [AdminController::class, "profile"])->name('admin.profile');


    Route::post("/admin/menu", [AdminController::class, "menuStore"])->name('menu.store');
    Route::delete("/admin/menu/{id}", [AdminController::class, "menuDestroy"])->name('menu.destroy');

    Route::put("/admin/menu/{id}", [AdminController::class, "menuUpdate"])->name('menu.update');
    Route::get("/admin/menu/create", [AdminController::class, "menuCreate"])->name('menu.create');
    Route::get("/admin/menu/edit/{id}", [AdminController::class, "menuEdit"])->name('menu.edit');

    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');


    Route::get("/orders", [HomeController::class, "orders"])->name('orders');

    Route::post("/cart", [HomeController::class, "addToCart"])->name('addToCart');
    Route::get("/cart", [HomeController::class, "cart"])->name('cart');
    Route::delete('/cart/{cartItem}', [HomeController::class, 'removeCartItem'])->name('cart.remove');
    Route::put('/cart/{cartItem}', [HomeController::class, 'updateCartItem'])->name('cart.update');
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('/order/cancel', [HomeController::class, 'cancelOrder'])->name('order.cancel');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::put("/profile/update/user", [HomeController::class, "profileUpdate"])->name('user.profile.update');
});
