<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('front.home');
Route::get('/about', [App\Http\Controllers\Frontend\IndexController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\Frontend\IndexController::class, 'contact'])->name('contact');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('front.shop');
Route::get('/shop/{category?}', [App\Http\Controllers\ProductCategoryController::class, 'index'])->name('front.product_category');
Route::get('/shop/{id?}/{slug?}', [App\Http\Controllers\ShopController::class, 'singleProduct'])->name('front.single_product');
Route::post('/product/{id?}/add-to-cart', [App\Http\Controllers\ShopController::class, 'addToCart'])->name('product.addToCart');
Route::post('/product/{id?}/add-to-wishlist', [App\Http\Controllers\ShopController::class, 'addToWishlist'])->name('product.addToWishlist');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'viewCart'])->name('front.cart');
Route::patch('/cart/update/{key}', [App\Http\Controllers\CartController::class, 'updateQuantity'])->name('front.updateCart');
Route::delete('/cart/remove/{key}', [App\Http\Controllers\CartController::class, 'removeItem'])->name('front.removeCart');

Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'viewWishlist'])->name('front.wishlist');
Route::delete('/wishlist/remove/{key}', [App\Http\Controllers\WishlistController::class, 'removeItem'])->name('front.removeCart');

Route::get('autosearch', [\App\Http\Controllers\SearchController::class, 'autoSearch'])->name('front.autosearch');
Route::get('search/{slug?}/{filter?}/', [\App\Http\Controllers\SearchController::class, 'search'])->name('front.search');
Route::get('just_for_you', [\App\Http\Controllers\SearchController::class, 'justForYou'])->name('front.justForYou');
Route::get('latest_products', [\App\Http\Controllers\SearchController::class, 'latestProducts'])->name('front.latestProducts');



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

    Route::resource('banner', BannerController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);

    Route::post('order_status/{id}', [App\Http\Controllers\OrderController::class, 'orderStatus'])->name('order.status');
    Route::get('order_details/{id}', [App\Http\Controllers\OrderController::class, 'orderDetails'])->name('order.details');

    Route::resource('coupon', CouponController::class);
});

Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'customer'])->name('customer');

    Route::get('checkout', [App\Http\Controllers\CheckoutController::class, 'viewCheckout'])->name('front.checkout');
    Route::post('checkout/store', [App\Http\Controllers\CheckoutController::class, 'checkoutStore'])->name('front.checkoutStore');

    Route::get('/myOrders', [App\Http\Controllers\Frontend\IndexController::class, 'myOrders'])->name('front.myOrders');
});

Route::get('/success', [App\Http\Controllers\CheckoutController::class, 'esewaPaySuccess']);
Route::get('/failure', [App\Http\Controllers\CheckoutController::class, 'esewaPayFailed']);
