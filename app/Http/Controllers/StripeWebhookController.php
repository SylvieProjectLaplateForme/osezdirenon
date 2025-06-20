<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Paiement;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            return response('Webhook error: ' . $e->getMessage(), 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // 🔍 Recherche du paiement lié par ID stripe
            $paiement = Paiement::where('stripe_payment_id', $session->payment_intent)->first();

            if ($paiement) {
                $paiement->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                    // 'stripe_receipt_url' => $session->receipt_url ?? null,
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}

