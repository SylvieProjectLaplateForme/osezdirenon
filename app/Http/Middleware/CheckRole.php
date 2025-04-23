<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Non authentifié.');
        }

        // Vérifie le rôle (par nom depuis la table roles)
        if ($role === 'admin' && $user->role->name !== 'admin') {
            abort(403, 'Accès refusé. Rôle admin requis.');
        }

        if ($role === 'editeur' && $user->role->name !== 'user') { // ou 'editeur'
            abort(403, 'Accès refusé. Rôle éditeur requis.');
        }

        // ✅ Important : retourne toujours la requête si tout est OK
        return $next($request);
    }
}
