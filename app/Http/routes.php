<?php

Route::get('/', function() {
    return view('guest.home');
});

Route::get('/admin', function() {
    return view('layouts.admin_layout');
});
