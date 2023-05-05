<?php

use Eshop\OrderBuilder\Api\OrderController;
use Eshop\OrderBuilder\Api\ProductController;
use Eshop\OrderBuilder\Api\ProductVariantController;
use Eshop\OrderBuilder\Api\ProductVariantOptionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. You're free to add
| as many additional routes to this file as your tool may require.
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

// Get products
// assign prefix to nova-vendor/OrderBuilder

Route::name('nova-vendor.order-builder.')->group(function () {
    Route::get('/products', [ProductController::class,'getAll'])->name('products');

    // Get product
    Route::get('/products/{id}', [ ProductController::class, 'getItem' ])->name('product');

    // Get product variants
    Route::get('/products/{product_id}/variants', [ProductVariantController::class, 'getAllByProduct'])
        ->name('products.variants');

    // Get product variant
    Route::get('/products/{product_id}/variants/{variant_id}',  [ProductVariantController::class, 'getItemByProduct'])
        ->name('products.variant');

    Route::get('/products/{product_id}/variants/{variant_id}/options', [ProductVariantOptionsController::class, 'getAllByProductAndVariant'])
        ->name('products.variant.options');

    Route::get('/products/{product_id}/variants/{variant_id}/options/organized', [ProductVariantOptionsController::class, 'getAllOrganizedByProductAndVariant'])
        ->name('products.variant.options.organized');

    Route::get('/order/{id}', [OrderController::class, 'getOrder'])->name('order');

    Route::get('/order/{id}/items', [OrderController::class, 'getItems'])->name('orders.items');

    Route::post('/order/{id}/items', [OrderController::class,'addItem'])->name('orders.items.store');

    Route::put('/order/{id}/items/{item_id}', [OrderController::class,'updateItem'])->name('orders.items.update');

    Route::delete('/order/{id}/items/{item_id}', [OrderController::class, 'deleteItem'])->name('orders.items.destroy');
});