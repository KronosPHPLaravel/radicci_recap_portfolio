<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PokeDetailController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

Route::get('/', [WelcomeController::class, 'Welcome']);

Route::get('/info', [InfoController::class, 'getInfo']);

Route::get('/contacts', [ContactsController::class, 'getContacts']);

/* Route::get('/services/{element}', function ($element) {
    return view('services', ['element' => $element]);
}); */

Route::get('/services/{element}', [ServicesController::class, 'getServices']);

/* Route::get('/pokelist', function () {
    $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=151')->json();

    return view('pokelist', ['pokemons'=>$response]);
});
 */
/* COMMENTO */
/* Route::get('/pokelist', function () {
    $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=9')->json();
$data = [];
foreach ($response['results'] as $element){
    $data[] = Http::get($element['url'])->json();
}
return view('pokelist', ['pokemons'=>$data]);
$response2 = Http::get($response['results'][0]['url'])->json();
foreach ($response2['result'] as $pokemon){
    return view('pokelist', ['pokemons'=>$pokemon['url']]);
}
     return view('pokelist', ['pokemons'=>$response]);
});  */
/* FINE COMMENTO */

Route::get('/pokelist', [PokemonController::class,'getRegione']);


/* Route::get('/pokedetail/{name}', function ($name) {
    $response = Http::get('https://pokeapi.co/api/v2/pokemon/'.$name)->json();

    return view('pokedetail', ['pokemon'=>$response]);
});  */

Route::get('/pokedetail/{name?}', [PokeDetailController::class, 'getPokeDetail']);
