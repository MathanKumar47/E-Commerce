<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\WishlistController;

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
//Frontend Route
Route::get('/',[HomeController::class,'index']);
Route::get('/view-details{id}',[HomeController::class,'view_details']);
Route::get('/product_by_cat{id}',[HomeController::class,'product_by_cat']);
Route::get('/product-by-subcat{id}',[HomeController::class,'product_by_subcat']);
Route::get('/search',[HomeController::class,'search']);
Route::get('/get_quick_view/{id}', [HomeController::class, 'getQuickView']);

//Backend Route
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});

//Admin Register and Login
Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']],function(){
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
});

//User Register and Login
Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBackHistory']],function(){
});
Route::get('/welcome',[UserController::class,'index'])->name('frontend.welcome');



// //Category
// Route::get('/categories/create',[CategoryController::class,'create']);
// Route::post('/categories/create',[CategoryController::class,'store'])->name('add.category');
// Route::get('/edit{category}',[CategoryController::class,'edit']);
// Route::put('/update{category}',[CategoryController::class,'update']);
// Route::get('/categories',[CategoryController::class,'index']);
// Route::delete('/delete{category}',[CategoryController::class,'destroy']);
// Route::get('/cat-status{category}',[CategoryController::class,'change_status']);

// //SubCategory
// Route::get('/sub-categories/create',[SubCategoryController::class,'create']);
// Route::post('/sub-categories/create',[SubCategoryController::class,'store'])->name('add.subcategory');
// Route::get('/subedit{subCategory}',[SubCategoryController::class,'edit']);
// Route::put('/subupdate{subCategory}',[SubCategoryController::class,'update']);
// Route::get('/sub-categories',[SubCategoryController::class,'index']);
// Route::delete('/subdelete{subCategory}',[SubCategoryController::class,'destroy']);
// Route::get('/subcat-status{subcategory}',[SubCategoryController::class,'change_status']);

// //Brand
// Route::get('/brands/create',[BrandController::class,'create']);
// Route::post('/brands/create',[BrandController::class,'store'])->name('add.brand');
// Route::get('/brandedit{brand}',[BrandController::class,'edit']);
// Route::put('/brandupdate{brand}',[BrandController::class,'update']);
// Route::get('/brands',[BrandController::class,'index']);
// Route::delete('/branddelete{brand}',[BrandController::class,'destroy']);
// Route::get('/brand-status{brand}',[BrandController::class,'change_status']);

// //Product
// Route::get('/products/create',[ProductController::class,'create']);
// Route::post('/products/create',[ProductController::class,'store'])->name('add.product');
// Route::get('/productedit{product}',[ProductController::class,'edit']);
// Route::put('/productupdate{product}',[ProductController::class,'update']);
// Route::get('/products',[ProductController::class,'index']);
// Route::delete('/productdelete{product}',[ProductController::class,'destroy']);
// Route::get('/product-status{product}',[ProductController::class,'change_status']);

//ADD-To-CART
Route::post('/add-to-cart',[CartController::class,'add_to_cart']);
Route::delete('/delete-cart/{id}',[CartController::class,'delete']);

//ADD-To-Whistlist
Route::post('/add-to-wishlist', [WishlistController::class,'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove', [WishlistController::class,'removeFromWishlist'])->name('wishlist.remove');
Route::get('load-cart-data',[WishlistController::class,'cartcount']);
//Checkout
// Route::get('/checkout',[CheckoutController::class,'index']);
// Route::post('/save-shipping-address',[CheckoutController::class,'save_shipping_address'])->name('shipping.save');
// Route::get('/payment',[CheckoutController::class,'payment']);
// Route::post('/order/place', [CheckoutController::class, 'order_place'])->name('order.place');

//Order
Route::get('/manage-order',[OrderController::class,'manage_order']);
Route::get('/view-order/{id}',[OrderController::class,'view_order']);


//Social_Login
//Google_Login
Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback']);

// SSLCOMMERZ Start
Route::get('/checkout', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END