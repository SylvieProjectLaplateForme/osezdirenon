<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // 👤 Affiche le profil de l'admin
    public function index()
{
    $user = Auth::user();
    return view('admin.profil.index', compact('user'));
}

    // 📝 Formulaire d'édition
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profil.edit', compact('user'));
    }

    // 🔍 Affiche le profil d'un admin au cas ou j'en aurai 2 dans le futur
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profil.show', compact('user'));
    }

    // 💾 Mise à jour du profil
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('admin.profil.index')->with('success', 'Profil mis à jour.');
}

    // ✅ Activation/désactivation
    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }

    public function listeEditeurs()
    {
        $editeurs = User::whereHas('role', function($query) {
            $query->where('name', 'editeur');
        })->get();
    
        return view('admin.editeurs.index', compact('editeurs'));
    }

}
