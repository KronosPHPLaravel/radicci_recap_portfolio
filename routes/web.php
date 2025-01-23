<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/contacts', function () {
    return view('contacts');
});