<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
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
    //products management
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
    Route::get('/products/change-status/{id}', [ProductController::class, 'changeStatus'])->name('products.change-status');

    //categories management
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    //orders management
    Route::get('/orders', [AdminController::class, 'adminOrders'])->name('orders');

    //users management
    Route::get('/users', [AdminController::class, 'usersList'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('users.edit');
    Route::post('/users/update/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::get('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/users/change-status/{id}', [AdminController::class, 'changeStatus'])->name('users.change-status');
});
