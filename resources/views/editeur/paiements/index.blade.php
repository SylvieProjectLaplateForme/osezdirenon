@extends('editeur.layout')

@section('title', 'Mes paiements')

@section('content')
<h1 class="text-2xl font-bold mb-6">Mes paiements</h1>

@if ($paiements->isEmpty())
    <p>Aucun paiement trouvé.</p>
@else
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-left text-sm">
                <th class="px-4 py-2">Publicité</th>
                <th class="px-4 py-2">Montant</th>
                <th class="px-4 py-2">Méthode</th>
                <th class="px-4 py-2">4 derniers chiffres</th>
                <th class="px-4 py-2">Payé le</th>
                <th class="px-4 py-2">Statut</th>
                <th class="px-4 py-2">Reçu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paiements as $paiement)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        @if($paiement->publicite)
                            <a href="{{ route('editeur.publicites.index') }}" class="text-blue-600 hover:underline">
                                {{ $paiement->publicite->titre }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ number_format($paiement->amount, 2, ',', ' ') }} €</td>
                    <td class="px-4 py-2">{{ ucfirst($paiement->payment_method ?? 'N/A') }}</td>
                    <td class="px-4 py-2">{{ $paiement->payment_last4 ?? '----' }}</td>
                    <td class="px-4 py-2">{{ $paiement->paid_at ? $paiement->paid_at->format('d/m/Y') : 'Non payé' }}</td>
                    <td class="px-4 py-2">
                        @if($paiement->status === 'payé')
                            <span class="text-green-600 font-semibold">Payé</span>
                        @else
                            <span class="text-red-600">En attente</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if($paiement->stripe_payment_id)
                            <a href="https://dashboard.stripe.com/payments/{{ $paiement->stripe_payment_id }}" target="_blank" class="text-blue-600 underline">Voir reçu</a>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
@endsection
