<?php

/*
 |----------------------------------------------------------
 | Projet                 : FestiShop
 | TPI 2026             : Travail Pratique Individuel
 | Candidat            : Kazi Siam
 | Description        : Définition de toutes les routes de l'application.
 |                             Trois niveaux d'accès : public (visiteur),
 |                             auth (client connecté), admin / manutentionnaire.
 |----------------------------------------------------------
 */

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
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [FrontendController::class, 'addToCart'])->name('product.add-to-cart');

// Routes groupées avec middleware auth
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/sync', [FrontendController::class, 'syncCart'])->name('product.cart-sync');
    Route::get('/cart/update-quantity', [FrontendController::class, 'updateCartQuantity'])->name('product.cart-update-quantity');
    Route::get('/cart/delete/{id}', [FrontendController::class, 'deleteCartItem'])->name('product.cart-delete');
    Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::post('/checkout-store', [FrontendController::class, 'checkoutStore'])->name('checkout-store');
    Route::get('/order-confirmation/{id}', [FrontendController::class, 'orderConfirmation'])->name('order-confirmation');
    Route::get('/orders', [FrontendController::class, 'orders'])->name('orders');
    Route::get('/order-details/{id}', [FrontendController::class, 'orderDetails'])->name('order-details');
    Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');
    Route::post('/profile-details-update', [FrontendController::class, 'profileDetailsUpdate'])->name('profile-details-update');
    Route::post('/profile-address-update', [FrontendController::class, 'profileAddressUpdate'])->name('profile-address-update');
    Route::post('/profile-password-update', [FrontendController::class, 'profilePasswordUpdate'])->name('profile-password-update');
});

// Routes admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Gestion des commandes
    Route::middleware(['manutentionnaire'])->group(function () {
        Route::get('/orders', [AdminController::class, 'adminOrders'])->name('orders.index');
        Route::get('/order-details/{id}', [AdminController::class, 'orderDetails'])->name('order-details');
        Route::get('/order-status-update/{id}', [AdminController::class, 'updateOrderStatus'])->name('order.status-update');
    });

    Route::middleware(['admin'])->group(function () {
        // Gestion des produits
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/products/change-status/{id}', [ProductController::class, 'changeStatus'])->name('products.change-status');

        // Gestion des catégories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

        // Gestion des utilisateurs
        Route::get('/users', [AdminController::class, 'usersList'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users/store', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('users.edit');
        Route::post('/users/update/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::get('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/users/change-status/{id}', [AdminController::class, 'changeStatus'])->name('users.change-status');
    });
});
