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

/* Route::get('/services/{element}', function ($element) {
    return view('services', ['element' => $element]);
}); */

Route::get('/services/{element}', function ($element) {
    $servizi = ['Consulenza', 'Marketplace', 'Gestionale'];
    foreach($servizi as $servizio){
        if ($servizio === $element){
            return view('services', ['element'=> $element]);
        }
    }
    abort(404);
});