<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Mail\PendingMail;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Command\CompleteCommand;

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
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::middleware('auth:api')->group( function () {

 Route::post('profile/{id}',[UserController::class,'profile']);
 Route::get('index',[CategoryController::class,'index']);
 Route::post('add_category',[CategoryController::class,'add_category']);
 Route::post('update_category/{id}',[CategoryController::class,'update']);
 Route::delete('destroy/{id}',[CategoryController::class,'delete']);


 Route::get('subcategory/{category_id}',[SubCategoryController::class,'subcategory']);
 Route::post('add_subcategory',[SubCategoryController::class,'add_subcategory']);
 Route::post('update_subcategory/{id}',[SubCategoryController::class,'update_subcategory']);
 Route::delete('subcategory_delete/{id}',[SubCategoryController::class,'subcategory_delete']);

 Route::get('product',[ProductController::class,'product']);
 Route::post('add_product',[ProductController::class,'add_product']);
 Route::post('update_product/{id}',[ProductController::class,'update_product']);
 Route::delete('delete/{id}',[ProductController::class,'destory']);
 Route::delete('image_delete/{id}',[ProductController::class,'image_delete']);

 Route::get('/product-by-cat/{subcategory_id}', [\App\Http\Controllers\frontend\ProductController::class, 'product_by_cat']);
Route::get('/product-detail/{product_id}', [\App\Http\Controllers\frontend\ProductController::class, 'product_detail']);
Route::get('search/{name}', [\App\Http\Controllers\frontend\ProductController::class, 'search']);
Route::post('products/{product}/ratings', [\App\Http\Controllers\frontend\ProductController::class, 'rating']);

Route::get('/cart-detail', [\App\Http\Controllers\frontend\CartController::class, 'cart_detail']);
Route::post('add-to-cart/{id}',  [\App\Http\Controllers\frontend\CartController::class,'addToCart']);
Route::post('update_cart/{id}',[\App\Http\Controllers\frontend\CartController::class,'update_cart']);
Route::post('cart_delete',[\App\Http\Controllers\frontend\CartController::class,'cart_delete']);
Route::post('/order', [\App\Http\Controllers\frontend\CartController::class, 'order']);

Route::get('/wishlist', [WishlistController::class, 'index']);
Route::post('add-to-wishlist/{product}', [WishlistController::class, 'addToWishlist']);
Route::delete('delete_wishlist/{id}',[WishlistController::class,'delete_wishlist']);

Route::post('/changePassword',[UserController::class,'changePassword']);


});

Route::post('forget-password',[UserController::class,'forgetPassword']);


