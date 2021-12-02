<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\FrontendController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

 Route::get('getCategory', [FrontendController::class, 'category']);
 Route::get('fetchproducts/{slug}', [FrontendController::class, 'product']);
 Route::get('productdetail/{category_slug}/{product_slug}', [FrontendController::class, 'productDetail']);

 Route::post('add-to-cart', [CartController::class, 'addtocart']);
 Route::get('cart', [CartController::class, 'viewcart']);
 Route::put('update-cartquantity/{cart_id}/{scope}', [CartController::class, 'upadtecartquantity']);
 Route::delete('delete-cartitem/{cart_id}', [CartController::class, 'deletecartitem']);

 Route::post('place-order', [CheckoutController::class, 'placeorder']);

 

/**Admin 
 * 
 * Route */
Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group(function () {

    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message' => 'You are In', 'status' => 200], 200);
    });

    //Category Routes
    Route::get('view-category', [CategoryController::class, 'index']);
    Route::post('store-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('all-category', [CategoryController::class, 'allcategory']);

    //Product Routes
    Route::get('view-product', [ProductController::class, 'index']);
    Route::post('store-product', [ProductController::class, 'store']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('update-product/{id}', [ProductController::class, 'update']);

});

/**User 
 * 
 * Route */
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
