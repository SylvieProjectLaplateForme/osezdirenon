<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicite;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    // ✅ Affiche le formulaire de création (éditeur)
    public function create()
    {
        return view('createPub');
    }

    // ✅ Enregistre une publicité (éditeur)
    public function store(Request $request)
    {
        if (!auth()->check()) abort(403);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'lien' => 'required|url',
            'image' => 'nullable|image|max:2048',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('publicites', 'public');
        }

        $validated['is_approved'] = false;
        $validated['paid'] = false;
        $validated['user_id'] = auth()->id();

        Publicite::create($validated);

        return redirect()->back()->with('success', 'Publicité créée !');
    }

    // ✅ Liste des publicités de l’éditeur
    public function mesPublicites()
    {
        $publicites = Publicite::where('user_id', auth()->id())->latest()->get();
        return view('editeur.pubCreate', compact('publicites'));
    }

    // ✅ Liste des pubs de l’éditeur en attente
    public function enAttenteEditeur()
    {
        $publicites = Publicite::where('user_id', auth()->id())
            ->where('is_approved', false)
            ->latest()
            ->get();

        return view('pubsEnAttente', compact('publicites'));
    }

    // ✅ Publicités publiques pour tout le monde (accès non connecté possible)
    public function afficherPubliques()
    {
        $publicites = Publicite::where('is_approved', true)
            ->where('paid', true)
            ->where(function($q){
                $q->whereNull('date_debut')->orWhere('date_debut', '<=', now());
            })
            ->where(function($q){
                $q->whereNull('date_fin')->orWhere('date_fin', '>=', now());
            })
            ->latest()
            ->get();

        return view('publicites.publiques', compact('publicites'));
    }
}
