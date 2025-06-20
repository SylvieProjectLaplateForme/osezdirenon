<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicite;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PubliciteController extends Controller
{
    // ✅ Affiche le formulaire de création (éditeur)
    public function create()
    {
        return view('editeur.publicites.createPub');
    }

    // ✅ Enregistre une publicité (éditeur)
    public function store(Request $request)
    {
        if (!auth()->check()) abort(403);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'lien' => 'required|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'date_debut' => 'nullable|date',
            // 'date_fin' => 'nullable|date|after_or_equal:date_debut', car obligatoire 1 mois
            
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('publicites', 'public');
        }

        $validated['is_approved'] = false;
        $validated['paid'] = false;
        $validated['user_id'] = auth()->id();

        Publicite::create($validated);

        return redirect()->back()->with('success', 'Publicité créée en attente de validation par administrateur !');
    }

    // ✅ Liste des publicités de l’éditeur
    public function mesPublicites()
    {
        $publicites = Publicite::where('user_id', auth()->id())->latest()->get();
        return view('editeur.publicites.index', compact('publicites'));
    }
    
    public function enAttentePaiement()
{
    $publicites = Publicite::where('user_id', auth()->id())
        ->where('is_approved', true)
        ->where('paid', false)
        ->latest()
        ->get();

    return view('editeur.publicites.aPayer', compact('publicites'));
}

    public function publicitesPayees()
{
    $publicites = Publicite::with('paiement') // relation vers table paiements
        ->where('user_id', auth()->id())
        ->where('paid', true)
        ->latest()
        ->get();

    return view('editeur.publicites.payees', compact('publicites'));
}

    // ✅ Liste des pubs de l’éditeur en attente
    public function enAttenteEditeur()
    {
        $publicites = Publicite::where('user_id', auth()->id())
            ->where('is_approved', false)
            ->latest()
            ->get();

        return view('editeur.publicites.enAttente', compact('publicites'));
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
