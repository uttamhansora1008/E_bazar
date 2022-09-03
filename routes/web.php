<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\frontend\ProductController as Productcontrollers;
use App\Http\Controllers\frontend\OrderController as Ordercontrollers;
use App\Http\Controllers\frontend\RatingController as Ratingcontrollers;
use App\Http\Controllers\frontend\UploadController as Uploadcontrollers;
use App\Http\Controllers\frontend\CartController as Cartcontrollers;
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
Route::get('/home', function () {
    return view('frontend.index');
});
Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
Auth::routes();

Route::middleware(['auth', 'isAdmin'])->group(function () {
  Route::get('admin', [HomeController::class, 'adminHome'])->name('admin.home');


    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('add-category', [CategoryController::class, 'create']);
    Route::post('add-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::post('update-category/{id}', [CategoryController::class, 'update']);
    Route::get('delete-category/{id}', [CategoryController::class, 'delete']);

    Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::get('add-subcategory', [SubcategoryController::class, 'create']);
    Route::post('add-subcategory', [SubcategoryController::class, 'store']);
    Route::get('edit-subcategory/{id}', [SubcategoryController::class, 'edit']);
    Route::post('update-subcategory/{id}', [SubcategoryController::class, 'update']);
    Route::get('delete-subcategory/{id}', [SubcategoryController::class, 'delete']);

    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::get('add-product', [ProductController::class, 'create']);
    Route::post('add-prdouct', [ProductController::class, 'store']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('update-product/{id}', [ProductController::class, 'update']);
    Route::get('delete-product/{id}', [ProductController::class, 'delete']);
    Route::get('/deleteimage/{id}', [ProductController::class, 'imagedelete']);
});

Route::middleware(['auth', 'isUser'])->group(function () {
  Route::get('user', [HomeController::class, 'home'])->name('home');

    Route::get('/products', [Productcontrollers::class, 'product']);
    Route::get('/product-by-cat/{subcategory_id}', [Productcontrollers::class, 'productbycat']);
    Route::get('/product-detail/{product_id}', [Productcontrollers::class, 'productdetail']);
    // Route::get('/cart-detail/{product_id}', [Productcontrollers::class, 'cart']);
    // Route::get('add-to-cart/{id}',  [Productcontrollers::class,'addToCart']);
   Route::get('update-cart', [Productcontrollers::class, 'update'])->name('update.cart');
   Route::get('remove-from-cart', [Productcontrollers::class, 'remove'])->name('remove_from_cart');
    Route::get('/place-order', [Ordercontrollers::class, 'orderAddress']);
    Route::post('/order', [Ordercontrollers::class, 'order']);
    Route::get('/order-confirm', [Ordercontrollers::class, 'orderConfirm']);
    Route::post('add-rating',[Ratingcontrollers::class, 'add']);
    Route::get('/show',[Uploadcontrollers::class,'show']);
    Route::post('add-review',[Ratingcontrollers::class, 'review'])->name('review');  
    
Route::get('/cart-detail', [Cartcontrollers::class, 'cartdetail']);
Route::get('/cart-Add/{product_id}', [Cartcontrollers::class, 'cartAdd']);
Route::get('/cart-Addsave/{product_id}', [Cartcontrollers::class, 'cartAddsave']);

Route::get('/cart-updateplus/{cart_id}', [Cartcontrollers::class, 'cartupdateplus']);
Route::get('/cart-updateminus/{cart_id}', [Cartcontrollers::class, 'cartupdateminus']);

Route::get('/cart-delete/{id}', [Cartcontrollers::class, 'delete']);

});






