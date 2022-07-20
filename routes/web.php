<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\TagController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\frontend\PageController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\frontend\CartsController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;




Route::get('/admin', function () {
    return view('welcome');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';
Route::get('/',[PageController::class,'home'])->name('home');
Route::get('/product-view/{id}',[PageController::class,'productview'])->name('product-view');
Route::get('/category/{id}',[PageController::class,'viewcategory'])->name('view-category');

//=========apply coupon===========
Route::post('/apply-coupon',[PageController::class,'applyCoupon'])->name('apply-coupon');
Route::get('/apply-destroy',[PageController::class,'destroyCoupon'])->name('apply-destroy');
Route::get('/checkout',[PageController::class,'checkout'])->name('checkout');


Route::get('/dashboard',[DashboardController::class, 'show'])->name('dashboard')->middleware(['auth']);
Route::resource('categories',CategoryController::class)->middleware(['auth']);
Route::resource('products',ProductController::class)->middleware(['auth']);
Route::resource('carts',CartsController::class)->middleware(['auth']);
Route::resource('posts',PostController::class)->middleware(['auth']);
Route::resource('coupons',CouponController::class)->middleware(['auth']);







Route::resource('tags',TagController::class)->middleware(['auth']);

