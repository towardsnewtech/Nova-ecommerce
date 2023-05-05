<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/test', function () {
//     dd(Category::factory()->create());
// });
// Route::get('/createcategory', function () {
//     $c = new Category();
//     $c->name = 'my category';
//     $c->description = 'my category description';
//     $c->save();

// });
// Route::get('/categories', function () {
//     return Category::all();

// });
// Route::get('/find', function () {
//     return Category::where('description', 'like', '%necessitatibus necessitatibus%')->get();

// });
 
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{category}', [CategoryProductController::class, 'get']);
Route::get('/products/{product}', [ProductController::class, 'get']);