<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la page de connexion.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Gère la soumission du formulaire de connexion.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Identifiants incorrects.',
            ])->onlyInput('email');
        }
    
        $request->session()->regenerate();
    
        $user = Auth::user();
    
        
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role->name === 'editeur') {
            return redirect()->route('editeur.dashboard');
        }
    
        //  Sinon, redirection par défaut
        // return redirect()->intended(RouteServiceProvider::HOME); erreur breeze defaut donc il faut changer
        return redirect('/'); // ou '/admin/dashboard' si tu veux forcer une destination

    }

    /**
     * Gère la déconnexion.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
