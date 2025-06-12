<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/cashier_detail', function () {
    return view('cashier_detail');
});

Route::get('/cashier_edit', function () {
    return view('cashier_edit');
});

Route::get('/cashier', function () {
    return view('cashier');
});

Route::get('/daftar', function () {
    return view('daftar');
});
