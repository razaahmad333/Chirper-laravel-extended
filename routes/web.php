<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    $likedChirps = $request->user()->likedChirps()->latest()->get();
    $myChirps = $request->user()->chirps()->latest()->get();
    return view('dashboard', ['likedChirps' => $likedChirps, 'myChirps' => $myChirps]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('follows', FollowController::class)
    ->only(['store',  'unfollow'])
    ->middleware(['auth', 'verified']);

Route::post('/chirps/{chirp}/like', [LikeController::class, 'toggleLike'])->middleware('auth')->name('chirps.like');

Route::resource('products', ProductController::class)
    ->only(['index', 'show'])
    ->middleware(['auth', 'verified']);

Route::post('/add-to-cart/{product}', [
    CartController::class,
    'addToCart'
])->middleware(['auth', 'verified'])->name('product.add-to-cart');


require __DIR__ . '/order.php';
require __DIR__ . '/auth.php';
