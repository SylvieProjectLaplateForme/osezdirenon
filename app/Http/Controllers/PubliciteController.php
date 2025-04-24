<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicite;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    // Affiche le formulaire de soumission
    public function create()
    {
        return view('createPub');
    }

    // Enregistre une nouvelle publicité avec image et validation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'lien' => 'required|url',
            'image' => 'nullable|image|max:2048',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('publicites', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Publicite::create($validated);

        return redirect()->back()->with('success', 'Publicité créée avec succès.');
    }

    public function index()
    {
        $publicites = Publicite::latest()->paginate(10);
        return view('admin.publicites.index', compact('publicites'));
    }

    public function toggle($id)
    {
        $pub = Publicite::findOrFail($id);
        $pub->is_active = !$pub->is_active;
        $pub->save();

        return redirect()->back()->with('success', 'Statut de la publicité mis à jour.');
    }

    public function destroy($id)
    {
        $pub = Publicite::findOrFail($id);

        if ($pub->image) {
            Storage::disk('public')->delete($pub->image);
        }

        $pub->delete();

        return redirect()->back()->with('success', 'Publicité supprimée.');
    }
}

