<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Les routes standards d'authentification
Auth::routes();

// Routes publiques (visiteur/client)
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/products', [FrontendController::class, 'products'])->name('products');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');

//grouped routes with auth middleware // ADD here checkout and confirmation routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [FrontendController::class, 'order'])->name('orders');
    Route::get('/users', [FrontendController::class, 'users'])->name('users');
    Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');
});

// Routes admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminController::class, 'adminProducts'])->name('products');
    Route::get('/orders', [AdminController::class, 'adminOrders'])->name('orders');
    Route::get('/users', [AdminController::class, 'usersList'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('users.edit');
    Route::post('/users/update/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::get('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/users/change-status/{id}', [AdminController::class, 'changeStatus'])->name('users.change-status');
});
