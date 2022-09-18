<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
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

Route::get('/', [HomeController::class,'getNewProduct'])->name('home');
Route::get('/shop', [ShopController::class,'getNewProduct'])->name('shop');
Route::get('/product-details', function(){
    return view('product-details');
})->name('product-details');

Route::get('/shop-cart', function(){
    return view('shop-cart');
})->name('shop-cart');

Route::get('/checkout', function(){
    return view('checkout');
})->name('checkout');

Route::get('/blog', function(){
    return view('blog');
})->name('blog');

Route::get('/contact', function(){
    return view('contact');
})->name('contact');

Route::get('/blog-details', function(){
    return view('blog-details');
})->name('blog-details');


Route::get('/test', function(){
    return view('test');
})->name('test');