<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RevenueController;
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
    return view('users.product-details');
})->name('product-details');

Route::get('/shop-cart', function(){
    return view('users.shop-cart');
})->name('shop-cart');

Route::get('/checkout', function(){
    return view('users.checkout');
})->name('checkout');

Route::get('/blog', function(){
    return view('users.blog');
})->name('blog');

Route::get('/contact', function(){
    return view('users.contact');
})->name('contact');

Route::get('/blog-details', function(){
    return view('users.blog-details');
})->name('blog-details');


Route::get('/test', function(){
    return view('test');
})->name('test');

Route::prefix('admin')->group(function(){
    Route::get('/', function(){
        return view('admins.index');
    })->name('admin');
    Route::get('/monthly-revenue', [RevenueController::class,'getRevenue'])->name('monthly-revenue');
});
Route::get('/rev', function(){
    return view('test');
})->name('test2');