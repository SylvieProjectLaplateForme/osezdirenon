<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Non authentifié.');
        }

        // Gestion des rôles
        if ($role === 'admin' && $user->role != User::ROLE_ADMIN) {
            abort(403, 'Accès refusé. Rôle admin requis.');
        }

        if ($role === 'editeur' && $user->role != User::ROLE_EDITEUR) {
            abort(403, 'Accès refusé. Rôle éditeur requis.');
        }

        // Si tout est ok, on continue la requête
        return $next($request);
    }
}
