<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicite;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    // ✅ Affiche le formulaire de soumission
    public function create()
    {
        return view('createPub');
    }

    // ✅ Enregistre une nouvelle publicité
    public function store(Request $request)
    {
        if (!auth()->check()) {
            abort(403, 'Vous devez être connecté pour soumettre une publicité.');
        }
    
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
        // ✅ Lie à l'utilisateur connecté
        $validated['user_id'] = auth()->id();


        Publicite::create($validated);

        return redirect()->back()->with('success', 'Publicité créée avec succès. Elle sera validée par un administrateur.');
    }

    // ✅ Affiche la liste des publicités (admin)
    public function index()
    {
        $publicites = Publicite::latest()->paginate(10);
        return view('admin.publicites.index', compact('publicites'));
    }

    public function enAttente()
{
    $publicites = Publicite::where('is_approved', false)->latest()->get();
    return view('admin.publicites.attente', compact('publicites'));
}

    // ✅ Valider une publicité
    public function valider($id)
    {
        $pub = Publicite::findOrFail($id);
        $pub->is_approved = true;
        $pub->save();

        return redirect()->back()->with('success', 'Publicité validée avec succès.');
    }

    // ✅ Supprimer une publicité
    public function destroy($id)
    {
        $pub = Publicite::findOrFail($id);

        if ($pub->image) {
            Storage::disk('public')->delete($pub->image);
        }

        $pub->delete();

        return redirect()->back()->with('success', 'Publicité supprimée.');
    }

    public function mesPublicites()
{
    $publicites = Publicite::where('user_id', auth()->id())->latest()->get();

    return view('editeur.publicites', compact('publicites'));
}
}

