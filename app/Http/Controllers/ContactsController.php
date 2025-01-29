<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function getContacts()
    {
        return view('contacts');
    }
}
