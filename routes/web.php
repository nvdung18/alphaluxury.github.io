<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\AdminShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminTrademarkController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminReceiptController;
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

Route::get('/shop-cart', [ShopController::class, 'show_shop_cart'])->name('shop-cart')->middleware('auth.roles');

Route::get('/checkout', function () {
    return view('users.checkout');
})->name('checkout');

Route::get('/contact', [ShopController::class,'contact'])->name('contact');

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
        Route::prefix('revenue')->group(function () {
            Route::get('/daily-revenue', [RevenueController::class, 'getDailyRevenue'])->name('daily-revenue');

            Route::get('/filter-rev', [RevenueController::class, 'filterRev'])->name('filter-revenue');

            Route::get('/weekly-revenue', [RevenueController::class, 'getWeeklyRevenue'])->name('weekly-revenue');

            Route::get('/monthly-revenue', [RevenueController::class, 'getMonthlyRevenue'])->name('monthly-revenue');

            Route::get('/chart-weekly-revenue', [RevenueController::class, 'getChartWeeklyRevenut'])->name('chart-weekly-revenue');

            Route::get('/chart-monthly-revenue', [RevenueController::class, 'getChartMonthlyRevenut'])->name('chart-monthly-revenue');
        });
    
        // product
        Route::prefix('product')->group(function () {
            Route::get('/', [AdminShopController::class,'getAllProductPaginate'])->name('product');

            Route::post('/add', [AdminShopController::class,'addProduct'])->name('add-product');

            Route::get('/details', [AdminShopController::class,'detailsProduct'])->name('details-product');

            Route::get('/edit', [AdminShopController::class,'editProduct'])->name('edit-product');

            Route::post('/edit', [AdminShopController::class,'confirmEdit'])->name('edit-product');

            Route::get('/delete', [AdminShopController::class,'deleteProduct'])->name('delete-product');
        });

        // trademark
        Route::prefix('trademark')->group(function () {

            Route::get('/', [AdminTrademarkController::class,'getAllTrademark'])->name('trademark');

            Route::get('/edit', [AdminTrademarkController::class,'editTrademark'])->name('edit-trademark');

            Route::post('/edit', [AdminTrademarkController::class,'confirmEdit'])->name('edit-trademark');

            Route::get('/delete', [AdminTrademarkController::class,'deleteTrademark'])->name('delete-trademark');

            Route::post('/add', [AdminTrademarkController::class,'addTrademark'])->name('add-trademark');
        });

        // order
        Route::prefix('order')->group(function () {

            Route::get('/', [AdminOrderController::class,'getAllOrderPaginate'])->name('order');

            Route::get('/details', [AdminOrderController::class,'getDetailsOrder'])->name('details-order');

            Route::post('/update-order', [AdminOrderController::class,'updateStatus'])->name('update-order');
        });

        // receipt
        Route::prefix('receipt')->group(function () {

            Route::get('/', [AdminReceiptController::class,'getAllReceiptPaginate'])->name('receipt');

            Route::get('/details', [AdminReceiptController::class,'getAllReceiptPaginate'])->name('receipt-details');
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
    // load infor user
    Route::get('/userpage',[UserController::class, 'show_form_user_page'])->name('user.page');

    // update infor user
    Route::post('/update-user',[UserController::class, 'updateUserInfor'])->name('user.update-infor');

    // detail order
    Route::get('/detail-order',[UserController::class, 'getDetailOrder'])->name('user.detail-order');

});

Route::prefix('cart')->group(function () {
        Route::post('/add_product',[ShopController::class, 'addproducttocart'])->name('add_product_to_cart')->middleware('auth.roles');
        Route::post('/check_cart',[ShopController::class, 'checkcart'])->name('checkcart');
        // Route::post('/check_cart_account', [ShopController::class, 'check_cart_account'])->name('checkcartaccount');
        Route::post('/update_cart', [ShopController::class, 'update_cart'])->name('update_cart');
        Route::post('/delete_cart',[ShopController::class, 'delete_cart'])->name('delete_cart');
});

Route::get('/branch', [ShopController::class, 'getProductByBranch'])->name('product-branch');
