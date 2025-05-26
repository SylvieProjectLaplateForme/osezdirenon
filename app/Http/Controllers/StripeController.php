<?php

namespace App\Http\Controllers;

use App\Models\Publicite;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Paiement;

class StripeController extends Controller
{
    public function checkout($id)
{
    $publicite = Publicite::findOrFail($id);

    if (!$publicite->is_approved || $publicite->paid) {
        return redirect()->back()->with('error', 'Publicité déjà payée ou non validée.');
    }

    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => 15000,
                'product_data' => [
                    'name' => $publicite->titre,
                ],
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('stripe.success', ['id' => $publicite->id]),
        'cancel_url' => route('stripe.cancel'),
    ]);

    return redirect($session->url);
}

public function success(Request $request)
{
    $id = $request->id;
    $publicite = Publicite::findOrFail($id);

    // ✅ Marquer la pub comme payée et active
    $publicite->paid = true;
    $publicite->is_active = true;

    // ✅ Définir la date de début à aujourd’hui et date de fin à +30 jours
    $publicite->date_debut = now();
    $publicite->valid_until = now()->addDays(30);
    $publicite->save();

    // ✅ Créer le paiement dans la table paiements
    Paiement::create([
        'user_id' => auth()->id(),
        'publicite_id' => $publicite->id,
        'amount' => 150.00,
        'payment_method' => 'card',
        'payment_last4' => '4242',//mode stripe test
        'stripe_payment_id' => 'manual_entry',
        'paid_at' => now(),
        'status' => 'paid',
    ]);

    return view('stripe.success', compact('publicite'));
}


public function cancel()
    {
        return redirect()->route('editeur.dashboard')->with('error', 'Paiement annulé.');
    }

}
