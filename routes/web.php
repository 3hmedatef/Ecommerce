<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;





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

Route::get('/',[AppController::class,'index'])->name('app.index');

Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/product/{slug}',[ShopController::class,'productDetails'])->name('shop.product.details');

Route::get('/Cart-wishlist-count',[ShopController::class,'getCartAndwishlistCount'])->name('shop.cart.wishlist.count');
Route::get('/cart',[CartController::class,'index'])->name('cart.index');

Route::get('/about',[AboutController::class,'index'])->name('about.index');
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');
Route::get('/blog',[ BlogController::class,'index'])->name('blog.index');


Route::post('/cart/store',[CartController::class,'addToCart'])->name('cart.store');
Route::put('/cart/update',[CartController::class,'updateCart'])->name('cart.update');
Route::delete('/cart/remove',[CartController::class,'removeItem'])->name('cart.remove');
Route::delete('/cart/clear',[CartController::class,'ClearCart'])->name('cart.clear');

Route::post('/wishlist/add',[WishlistController::class,'addproductToWishlist'])->name('wishlist.store');
Route::get('/wishlist',[WishlistController::class,'getwishlistedproducts'])->name('wishlist.list')
;
Route::delete('/wishlist/remove',[WishlistController::class,'removproductfromwishlist'])->name('wishlist.remove');
Route::delete('/wishlist/clear',[WishlistController::class,'clearwishlist'])->name('wishlist.clear');
Route::post('/wishlist/move-to-cart',[WishlistController::class,'moveToCart'])->name('wishlist.move.to.cart');




Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/my-account',[UserController::class,'index'])->name('user.index');
});
Route::middleware(['auth','auth.admin'])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
});

