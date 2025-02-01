<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSend;

class ContactController extends Controller
{
    public function getContact()
    {
        return view('contacts');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $mail = [
            'name' => $request->name,
            'email' => $request->email,
            'text' => $request->text,
        ];
        
        Mail::to($request->input('email'))->send(new ContactSend($mail));
        session()->flash('status', 'Messaggio inviato con successo!');
        return redirect('/contacts');
    }
}
