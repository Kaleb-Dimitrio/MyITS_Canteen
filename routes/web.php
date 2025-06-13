<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --- PUBLIC ROUTES ---
// These routes are accessible to everyone, including guests.

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
// This section is now updated to use the '/customer' prefix.
Route::middleware(['auth:web'])->prefix('customer')->group(function () {
    // 'auth:web' uses the default guard, which we configured for customers.

    Route::get('/', function() {
        // This now correctly points to your customer.blade.php file
        // and is accessible at yoursite.com/customer
        return view('customer');
    })->name('customer.dashboard');

    // You can add other customer-only routes here, e.g., /profile, /my-orders
});
