<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Affiche la page de contact
    public function index()
    {
        return view('contact');
    }

    // Traite l'envoi du formulaire
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('home')->with('success', 'Merci pour votre message !');
    }
}


