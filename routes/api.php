<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group( ['middleware' => ['auth:api']], function()
{ 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);   
    Route::delete('/delete', [AuthController::class, 'deleteUser']);

    Route::post('/search/user', 'App\Http\Controllers\UserController@search');
    Route::get('/users', 'App\Http\Controllers\UserController@users');
    Route::resource('/user', 'App\Http\Controllers\UserController');
});

Route::get('/brands', [BrandsController::class, 'index']);
Route::get('/brands/{id}', [BrandsController::class, 'show']);
Route::post('/brands', [BrandsController::class, 'store']);
Route::put('/brands/{id}', [BrandsController::class, 'update']);
Route::delete('/brands/{id}', [BrandsController::class, 'delete']);

Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/all-categories', [CategoriesController::class, 'categories']);
Route::get('/categories/{id}', [CategoriesController::class, 'show']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::put('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'delete']);

Route::post('/location', [CategoriesController::class, 'store']);
Route::put('/location/{id}', [CategoriesController::class, 'update']);
Route::delete('/location/{id}', [CategoriesController::class, 'delete']);

Route::get('/products', [ProductsController::class, 'index']); 
Route::get('/all-products', [ProductsController::class, 'products']); 
Route::get('/products/{id}', [ProductsController::class, 'show']); 
Route::post('/products', [ProductsController::class, 'store']);
Route::put('/products/{id}', [ProductsController::class, 'update']); 
Route::delete('/products/{id}', [ProductsController::class, 'delete']);

Route::group( ['middleware' => ['auth:api']], function()
{ 
    Route::get('/orders', [OrdersController::class, 'index']);
    Route::get('/all-orders', [OrdersController::class, 'orders']);
    Route::get('/orders/{id}', [OrdersController::class, 'show']);
    Route::post('/orders', [OrdersController::class, 'store']);
    Route::get('/orders/{id}/items', [OrdersController::class, 'get_order_items']);
    Route::get('/user/{id}/orders', [OrdersController::class, 'get_user_orders']);
    Route::put('/orders/{id}/status', [OrdersController::class, 'change_order_status']);
});