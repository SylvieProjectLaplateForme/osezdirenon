<?php

namespace App\Http\Controllers;

use App\Models\Publicite;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function checkout($id)
{
    $publicite = \App\Models\Publicite::findOrFail($id);

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

    // ✅ Mise à jour si besoin :
    $publicite->paid = true;
    $publicite->save();

    // ✅ Envoi de la variable à la vue
    return view('stripe.success', compact('publicite'));
}
public function cancel()
    {
        return redirect()->route('editeur.dashboard')->with('error', 'Paiement annulé.');
    }

}
