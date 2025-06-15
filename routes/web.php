<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CashierDashboardController;
use App\Http\Controllers\OrderController;

Route::post('/customer/order/store', [OrderController::class, 'store'])->name('customer.order.store');


// The root URL of your website will show the login form.
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login-page');

// Routes to handle the full authentication process.
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Routes to handle the registration process.
Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/daftar', [RegisterController::class, 'register']);


// --- PROTECTED ADMIN ROUTES ---
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminTokoController::class, 'index'])->name('admin.dashboard');

    Route::get('/toko/edit', [AdminEditController::class, 'showForm'])->name('admin.edit');

    // Route to handle the form submission
    Route::post('/toko/store', [AdminEditController::class, 'storeOrUpdate'])->name('admin.toko.store');

    Route::get('/toko/{toko}', [AdminTokoController::class, 'showDetail'])->name('admin.toko.detail');
    Route::get('/order/{order}', [AdminTokoController::class, 'showOrderDetail'])->name('admin.order.detail');
    
    Route::delete('/toko/{id}', function($id) {
        \App\Models\Toko::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Toko berhasil dihapus.');
    })->name('admin.toko.delete');
});


// --- PROTECTED CASHIER ROUTES ---
Route::middleware(['auth:cashier'])->prefix('cashier')->group(function () {
    Route::get('/', [CashierDashboardController::class, 'index'])->name('cashier.dashboard');

    Route::get('/detail', function () {
        return view('cashier_detail');
    })->name('cashier.detail');

    Route::get('/edit', function () {
        return view('cashier_edit');
    })->name('cashier.edit');

    
    Route::post('/order/{id}/approve', [OrderController::class, 'approve'])->name('order.approve');
    Route::post('/order/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::post('/order/{id}/done', [OrderController::class, 'done'])->name('order.done');

});


// --- PROTECTED CUSTOMER ROUTES ---
// This section is now updated to use the '/customer' prefix.

Route::middleware(['auth:customer'])->prefix('customer')->group(function () {
    Route::get('/', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');

     // Tampilkan menu milik toko tertentu
    Route::get('/menu/{toko}', [CustomerDashboardController::class, 'showMenu'])->name('customer.menu');

    Route::get('/order', function() {
        return view('customer_order');
    })->name('customer.order');
});

