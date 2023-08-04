<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Category
Route::get('/categories/create',[CategoryController::class,'create']);
Route::post('/categories/create',[CategoryController::class,'store'])->name('add.category');
Route::get('/edit{category}',[CategoryController::class,'edit']);
Route::put('/update{category}',[CategoryController::class,'update']);
Route::get('/categories',[CategoryController::class,'index']);
Route::delete('/delete{category}',[CategoryController::class,'destroy']);
Route::get('/cat-status{category}',[CategoryController::class,'change_status']);

//SubCategory
Route::get('/sub-categories/create',[SubCategoryController::class,'create']);
Route::post('/sub-categories/create',[SubCategoryController::class,'store'])->name('add.subcategory');
Route::get('/subedit{subCategory}',[SubCategoryController::class,'edit']);
Route::put('/subupdate{subCategory}',[SubCategoryController::class,'update']);
Route::get('/sub-categories',[SubCategoryController::class,'index']);
Route::delete('/subdelete{subCategory}',[SubCategoryController::class,'destroy']);
Route::get('/subcat-status{subcategory}',[SubCategoryController::class,'change_status']);

//Brand
Route::get('/brands/create',[BrandController::class,'create']);
Route::post('/brands/create',[BrandController::class,'store'])->name('add.brand');
Route::get('/brandedit{brand}',[BrandController::class,'edit']);
Route::put('/brandupdate{brand}',[BrandController::class,'update']);
Route::get('/brands',[BrandController::class,'index']);
Route::delete('/branddelete{brand}',[BrandController::class,'destroy']);
Route::get('/brand-status{brand}',[BrandController::class,'change_status']);

//Product
Route::get('/products/create',[ProductController::class,'create']);
Route::post('/products/create',[ProductController::class,'store'])->name('add.product');
Route::get('/productedit{product}',[ProductController::class,'edit']);
Route::put('/productupdate{product}',[ProductController::class,'update']);
Route::get('/products',[ProductController::class,'index']);
Route::delete('/productdelete{product}',[ProductController::class,'destroy']);
Route::get('/product-status{product}',[ProductController::class,'change_status']);