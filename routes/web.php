<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;

use function PHPUnit\Framework\returnSelf;

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

//Login/register
Route::get('/register', function(){
    return view('users.register');
})->name('register');

Route::post('/addUser', [UserController::class, 'add'])->name('addUser');

Route::get('/login',[UserController::class,'showlogin'])->name('user.login');
Route::post('/checklogin',[UserController::class,'checklogin'])->name('user.checklogin');
Route::get('/chinh-sach-rieng-tu', function(){
    return '<h1>Chinh Sach Rieng Tu</h1>';
});

Route::get('/auth/facebook', function(){
    return Socialite::driver('facebook')->redirect();;
});

Route::get('/auth/facebook/callback', function(){
    return 'Callback Login Facebook';
});