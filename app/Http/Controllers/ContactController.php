<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function afficher()
    {
        return view('contact');
    }

    public function envoyer(Request $request)
    {
        // ✅ Validation des données du formulaire
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:10'
            
        ]);

        // ✅ Enregistrement dans la base
        ContactMessage::create($validated);

        // ✅ Envoi de l’email
        Mail::send('emails.contact', ['data' => $validated], function ($message) {
            $message->to('sosylvie1@gmail.com')
                    ->subject('Nouveau message du formulaire');
        });

        // ✅ Redirection avec message
        return redirect()->route('home')->with('success', 'Merci pour votre message !');
    }
}
