<?php

Route::get('/', function() {
    return view('guest.home');
});

Route::get('/admin', function() {
    return view('layouts.admin_layout');
});

// Views
Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/admin', function() {
    return redirect()->route('dashboard');
});