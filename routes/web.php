<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// The root URL of your website will show the login form.
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login-page');

// Routes to handle the full authentication process.
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes to handle the registration process.
Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/daftar', [RegisterController::class, 'register']);


// --- PROTECTED ADMIN ROUTES ---
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    // This group ensures only a logged-in Admin can access these URLs.
    // The URL will look like: yoursite.com/admin/...

    Route::get('/', function () {
        return view('admin');
    })->name('admin.dashboard');

    // New route for editing admin-related content
    Route::get('/edit', function () {
        return view('admin_edit');
    })->name('admin.edit');

    // Add other admin-only routes here.
});


// --- PROTECTED CASHIER ROUTES ---
Route::middleware(['auth:cashier'])->prefix('cashier')->group(function () {
    // This group ensures only a logged-in Cashier can access these URLs.
    // The URL will look like: yoursite.com/cashier/...

    Route::get('/', function () {
        return view('cashier');
    })->name('cashier.dashboard');

    Route::get('/detail', function () {
        return view('cashier_detail');
    })->name('cashier.detail');

    Route::get('/edit', function () {
        return view('cashier_edit');
    })->name('cashier.edit');
});


// --- PROTECTED CUSTOMER ROUTES ---
// This section is now updated to use the '/customer' prefix.
Route::middleware(['auth:customer'])->prefix('customer')->group(function () {

    Route::get('/', function() {
        return view('customer');
    })->name('customer.dashboard');

    // New route for the customer's menu page
    Route::get('/menu', function() {
        return view('customer_menu');
    })->name('customer.menu');

    // New route for the customer's order page
    Route::get('/order', function() {
        return view('customer_order');
    })->name('customer.order');

});