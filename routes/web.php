<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });

// // Better to use a controller for the home route
// Route::get('/', [HomeController::class, 'index'])->name('welcome');


// // Resource Auth Route - Must be logged in to create and manage products

// Route::middleware(['auth'])->prefix('dashboard')->group(function () {
//     Route::resource('products', ProductController::class);
//     Route::get('products/view/{id}', [ProductController::class, 'view'])->name('products.view');
// });

Route::get('/', [ProductController::class, 'index'])->name('products.index'); 


Route::resource('dashboard/products', ProductController::class)
    ->middleware('auth')
    ->except(['index', 'show']);

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
