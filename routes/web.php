<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CheckoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/detail/{id}',[HomeController::class,'detail'])->name('detail');
Route::get('/category/{cat}',[HomeController::class,'category'])->name('home.category');

Route::match(['GET','POST'],"/login",[LoginController::class,'login'])->name('login');
Route::match(['GET','POST'],"/register",[LoginController::class,'register'])->name('register');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/log',[LoginController::class,'log'])->name('log');
Route::prefix('admin')->middleware('auth')->middleware('admin')->group(function () {
    Route::get('/',[DashBoardController::class,'index'])->name('admin.index');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('voucher', VoucherController::class);
    Route::resource('orders', OrderController::class);
});


Route::prefix('customer')->group(function () {
Route::resource('cart', CartController::class); 
Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('/checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');
        Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::post('/checkout/redeem', [CheckoutController::class, 'redeemCode'])->name('checkout.redeem'); 
});

