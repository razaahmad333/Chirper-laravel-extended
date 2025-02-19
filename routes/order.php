<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::prefix('order')->group(function () {
        Route::get('/list', [OrderController::class, 'list'])->name('order.list');
        Route::get('/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::post('/place', [OrderController::class, 'placeOrder'])->name('order.place');
    });

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
});
