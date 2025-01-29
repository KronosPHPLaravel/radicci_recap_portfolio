<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\View\View;
 
class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function getServizi($x)
    {
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

        return $servizi();
    }
}
