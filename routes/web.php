<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


// The root URL of your website will show the login form.
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login-page');

// Routes to handle the full authentication process.
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// The registration page is also public.
Route::get('/daftar', function () {
    return view('daftar');
})->name('register');


// --- PROTECTED ADMIN ROUTES ---
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    // This group ensures only a logged-in Admin can access these URLs.
    // The URL will look like: yoursite.com/admin/...

    Route::get('/', function () {
        return view('admin');
    })->name('admin.dashboard');

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

    // Add other cashier-only routes here.
});


// --- PROTECTED CUSTOMER ROUTES ---
// You will add routes for logged-in customers here later.
// For example:
/*
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');
});
*/