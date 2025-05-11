<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paiement;

class PaiementController extends Controller
{
    public function index()
    {
        // Récupérer les paiements de l'utilisateur connecté
        $paiements = Paiement::where('user_id', Auth::id())
            ->with('publicite')
            ->orderBy('paid_at', 'desc')
            ->get();

        return view('paiements.index', compact('paiements'));
    }
    public function show($id)
{
    $paiement = Paiement::where('user_id', Auth::id())
        ->with('publicite')
        ->findOrFail($id);

    return view('paiements.show', compact('paiement'));
}
}

