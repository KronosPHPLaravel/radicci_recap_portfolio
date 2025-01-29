<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function Welcome() {
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
}
}
