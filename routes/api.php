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

Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::get('/products/{product}', 'App\Http\Controllers\ProductController@get');
Route::get('/products/{product}/variants', 'App\Http\Controllers\ProductController@variants');
Route::get('/category', 'App\Http\Controllers\CategoryController@index');
Route::post('/category/{category}', 'App\Http\Controllers\CategoryProductController@get');
Route::get('/Filter', 'App\Http\Controllers\FilterController@index');
Route::get('/FilterGroup', 'App\Http\Controllers\FilterGroupController@index');
Route::get('/variant/{product}', 'App\Http\Controllers\VariantController@get');
Route::get('/optionGroup', 'App\Http\Controllers\OptionGroupController@index');
Route::get('/option/{variant}', 'App\Http\Controllers\OptionController@get');
Route::get('/menu', 'App\Http\Controllers\MenuController@index');
Route::get('/page/{url}', 'App\Http\Controllers\PageController@get');
Route::post('/order', 'App\Http\Controllers\OrderController@store');
Route::post('/customer', 'App\Http\Controllers\CustomerController@get');
Route::post('/save_customer', 'App\Http\Controllers\CustomerController@store');
Route::get('/stores', 'App\Http\Controllers\StoreController@get');