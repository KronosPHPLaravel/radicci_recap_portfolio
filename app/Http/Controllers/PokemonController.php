<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function getRegione(Request $request)
    {
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
                $limit = $regionOffset + $regionLimit - $offset;
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
    }
}
