<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // ✅ à ajouter
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la page de connexion.
     */
    public function create(Request $request)
    {
        // 🔐 Stocker l’URL de redirection si précisée
        if ($request->has('redirect')) {
            session(['url.intended' => $request->query('redirect')]);
        }

        // ✅ Afficher un message si besoin
        if ($request->has('message') && $request->query('message') === 'connect_pub') {
            session()->flash('message_pub', '⚠️ Vous devez être connecté pour proposer une publicité.');
        }

        return view('auth.login');
    }

    /**
     * Soumission du formulaire de connexion
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');

        // ✅ Vérifie si l'utilisateur existe
        $userExists = User::where('email', $email)->exists();

        if (!$userExists) {
            return back()->withErrors([
                'email' => 'Aucun compte ne correspond à cette adresse email.',
            ])->onlyInput('email');
        }

        // ✅ Tentative d’authentification
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Mot de passe incorrect.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        // ✅ Priorité à l’URL en session si elle existe
        if (session()->has('url.intended')) {
            return redirect()->intended();
        }

        // ✅ Sinon, redirection selon le rôle
        return redirect()->to($this->redirectTo(Auth::user()));
    }

    /**
     * Détermine la redirection selon le rôle
     */
    public function redirectTo($user)
    {
        if ($user->role->name === 'admin') {
            return route('admin.dashboard');
        } elseif ($user->role->name === 'editeur') {
            return route('editeur.dashboard');
        }

        return '/';
    }

    /**
     * Déconnexion
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
