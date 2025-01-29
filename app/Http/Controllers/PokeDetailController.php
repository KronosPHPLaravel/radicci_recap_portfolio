<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PokeDetailController extends Controller
{
    public function getPokeDetail(Request $request, $name = null)
    {
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
    }
}
