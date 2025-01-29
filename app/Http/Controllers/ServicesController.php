<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function getServices($element)
    {
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
    }
}
