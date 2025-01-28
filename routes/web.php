<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    $servizi = [
        [
            'name' => 'Consulenza',
            'description' => '...',
            'image' => 'https://picsum.photos/id/88/200/200',
        ],
        [
            'name' => 'Marketplace',
            'description' => '...',
            'image' => 'https://picsum.photos/id/35/200/200',
        ],
        [
            'name' => 'Gestionale',
            'description' => '...',
            'image' => 'https://picsum.photos/id/67/200/200',
        ],
    ];

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
    /* $servizi = ['Consulenza', 'Marketplace', 'Gestionale']; */
    $servizi = [
        [
            'name' => 'Consulenza',
            'description' => '...',
            'image' => 'https://picsum.photos/id/88/200/200',
        ],
        [
            'name' => 'Marketplace',
            'description' => '...',
            'image' => 'https://picsum.photos/id/35/200/200',
        ],
        [
            'name' => 'Gestionale',
            'description' => '...',
            'image' => 'https://picsum.photos/id/67/200/200',
        ],
    ];
    foreach ($servizi as $servizio) {
        if ($servizio['name'] === $element) {
            return view('services', ['element' => $element]);
        }
    }
    abort(404);
});

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

Route::get('/pokelist', function (Request $request) {
    $limit = 9; 
    $page = $request->query('page', 1); 
    $region = $request->query('region', 'Kanto'); 

    $regions = [
        'Kanto' => ['offset' => 0, 'limit' => 151],
        'Johto' => ['offset' => 151, 'limit' => 100],
        'Hoenn' => ['offset' => 251, 'limit' => 135],
        'Sinnoh' => ['offset' => 386, 'limit' => 107],
        'Unova' => ['offset' => 493, 'limit' => 156],
        'Kalos' => ['offset' => 649, 'limit' => 72],
        'Alola' => ['offset' => 721, 'limit' => 88],
        'Galar-Hisui' => ['offset' => 809, 'limit' => 96],
        'Paldea' => ['offset' => 905, 'limit' => 120],
        'Extra' => ['offset' => 1025, 'limit' => 279],
    ];

    if (isset($regions[$region])) {
        $regionOffset = $regions[$region]['offset'];
        $regionLimit = $regions[$region]['limit'];

        $offset = $regionOffset + ($page - 1) * $limit;

        if ($offset + $limit > $regionOffset + $regionLimit) {
            $limit = ($regionOffset + $regionLimit) - $offset; 
        }
    } else {
        $regionLimit = 0;
    }

    $totalPages = ceil($regionLimit / 9);

    $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=$limit&offset=$offset")->json();

    $data = [];
    foreach ($response['results'] as $element) {
        $data[] = Http::get($element['url'])->json();
    }

    $startPage = max(1, $page - 1); 
    $endPage = min($totalPages, $page + 1);

    return view('pokelist', [
        'pokemons' => $data,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'visiblePages' => 3,
        'startPage' => $startPage,
        'endPage' => $endPage,
        'region' => $region, // Regione corrente
    ]);
});


/* Route::get('/pokedetail/{name}', function ($name) {
    $response = Http::get('https://pokeapi.co/api/v2/pokemon/'.$name)->json();

    return view('pokedetail', ['pokemon'=>$response]);
});  */

Route::get('/pokedetail/{name?}', function (Illuminate\Http\Request $request, $name = null) {
    if (!$name) {
        $name = $request->query('name');
    }

    $response = Http::get('https://pokeapi.co/api/v2/pokemon/' . strtolower($name))->json();

    $speciesUrl = $response['species']['url']; 
        $speciesResponse = Http::get($speciesUrl)->json();

        $variants = [];
        foreach ($speciesResponse['varieties'] as $variety) {
            $variantName = $variety['pokemon']['name'];

            $variantData = Http::get($variety['pokemon']['url'])->json(); 
            $variants[] = [
                'name' => $variantName,
                'sprites' => $variantData['sprites'],
            ];
        }

    return view('pokedetail', [
        'pokemon' => $response,
        'variants' => $variants, 
    ]);
});