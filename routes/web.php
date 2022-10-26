<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\AdminShopController;
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

Route::get('/', [HomeController::class, 'getProductSlider'])->name('home');
Route::prefix('shop')->group(function () {
    Route::name('shop.')->group(function () {
        
        // product for men
        Route::prefix('/watch-men')->group(function () {

            Route::get('/', [ShopController::class, 'getProductMaleP'])->name('men');

            Route::get('/product-details', function () {
                return view('users.product-details');
            })->name('product-details');

            // route for filter
            Route::prefix('/')->group(function () {

                Route::get('/style/{type}-price-{price}', [ShopController::class, 'getFilterProduct'])->name('style-men-p')->where('price', '[0-9]+');

                Route::get('/style/{type}-{branch}', [ShopController::class, 'getFilterProduct'])->name('style-men-b')->where('branch', '[a-z]+[0-9]+');

                Route::get('/style/{type}-{branch}-price-{price}', [ShopController::class, 'getFilterProduct'])->name('style-men-bp');
            });
        });

        // product for women
        Route::prefix('/watch-women')->group(function () {
            Route::get('/', [ShopController::class, 'getProductFemaleP'])->name('women');

            // route for filter
            Route::prefix('/')->group(function () {

                Route::get('/style/{type}-price-{price}', [ShopController::class, 'getFilterProduct'])->name('style-women-p')->where('price', '[0-9]+');

                Route::get('/style/{type}-{branch}', [ShopController::class, 'getFilterProduct'])->name('style-women-b')->where('branch', '[a-z]+[0-9]+');

                Route::get('/style/{type}-{branch}-price-{price}', [ShopController::class, 'getFilterProduct'])->name('style-women-bp');
            });
        });
    });
});

// Route::get('/product-details', function(){
//     return view('users.product-details');
// })->name('product-details');

Route::get('/shop-cart', function () {
    return view('users.shop-cart');
})->name('shop-cart');

Route::get('/checkout', function () {
    return view('users.checkout');
})->name('checkout');

Route::get('/blog', function () {
    return view('users.blog');
})->name('blog');

Route::get('/contact', function () {
    return view('users.contact');
})->name('contact');

Route::get('/blog-details', function () {
    return view('users.blog-details');
})->name('blog-details');


Route::get('/test', function () {
    return view('test');
})->name('test');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admins.index');
    })->name('admin');
    Route::name('ad.')->group(function () {
    
        // revenue
        Route::get('/monthly-revenue', [RevenueController::class, 'getRevenue'])->name('monthly-revenue');
    
        // product
        Route::prefix('product')->group(function () {
            Route::get('/', [AdminShopController::class,'getAllProductPaginate'])->name('product');

            Route::post('/add', [AdminShopController::class,'addProduct'])->name('add-product');

            Route::get('/details', [AdminShopController::class,'detailsProduct'])->name('details-product');

            Route::get('/edit', [AdminShopController::class,'editProduct'])->name('edit-product');

            Route::post('/edit', [AdminShopController::class,'confirmEdit'])->name('edit-product');

            Route::get('/delete', [AdminShopController::class,'deleteProduct'])->name('delete-product');
        });
    });
});
Route::get('/rev', function () {
    return view('test');
})->name('test2');

// Route::get('/', function(){
//     return view('test');
// })->name('test');