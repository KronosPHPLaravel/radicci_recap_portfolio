<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $servizi = ['Consulenza', 'Marketplace', 'Gestionale'];
    
    return view('welcome', ['servizi' => $servizi]);
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/contacts', function () {
    return view('contacts');
});