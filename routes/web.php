<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\AdminShopController;
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

Route::get('/', [HomeController::class, 'getProductSlider'])->name('home');
Route::prefix('shop')->group(function () {
    Route::name('shop.')->group(function () {
        
        // product for men
        Route::prefix('/watch-men')->group(function () {

            Route::get('/', [ShopController::class, 'getProductMaleP'])->name('men');

            Route::get('/product-details/{nameproduct}/{gender}', [ShopController::class, 'productDetails'])->name('product-details');

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
            
            Route::get('/product-details/{nameproduct}/{gender}', [ShopController::class, 'productDetails'])->name('product-details');
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

Route::get('/shop-cart', [ShopController::class, 'show_shop_cart'])->name('shop-cart');

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

Route::get('/resetpassword', [UserController::class, 'formresetpw'])->name('resetpw');

Route::post('/recover-pass',[UserController::class, 'resetpasswordCallback'])->name('recover_pass');

Route::post('/newpw', [UserController::class, 'newpassword'])->name('changepassword');

Route::get('/forgotpassword', [UserController::class, 'forgotpw'])->name('forgotpassword');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('user')->group(function () {
    Route::get('/userpage',[UserController::class, 'show_form_user_page'])->name('user.page');
});

Route::prefix('cart')->group(function () {
    Route::post('/add_product',[ShopController::class, 'addproducttocart'])->name('add_product_to_cart');
    Route::post('/check_cart',[ShopController::class, 'checkcart'])->name('checkcart');
    // Route::post('/check_cart_account', [ShopController::class, 'check_cart_account'])->name('checkcartaccount');
    Route::post('/update_cart', [ShopController::class, 'update_cart'])->name('update_cart');
    Route::post('/delete_cart',[ShopController::class, 'delete_cart'])->name('delete_cart');
});
