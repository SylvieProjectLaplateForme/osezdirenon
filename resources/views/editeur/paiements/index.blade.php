@extends('editeur.layout')

@section('title', 'Mes paiements')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">💳 Mes paiements</h1>

    @if ($paiements->isEmpty())
        <p class="text-gray-600">Aucun paiement trouvé.</p>
    @else

        {{-- ✅ VERSION MOBILE --}}
        <div class="space-y-4 md:hidden">
            @foreach ($paiements as $paiement)
                <div class="bg-white shadow rounded p-4 text-sm">
                    <h2 class="font-semibold text-gray-800 mb-2">
                        Publicité :
                        @if ($paiement->publicite)
                            <a href="{{ route('editeur.publicites.index') }}" class="text-blue-600 underline">
                                {{ $paiement->publicite->titre }}
                            </a>
                        @else
                            N/A
                        @endif
                    </h2>

                    <p>💶 Montant : {{ number_format($paiement->amount, 2, ',', ' ') }} €</p>
                    <p>Méthode : {{ ucfirst($paiement->payment_method ?? 'N/A') }}</p>
                    <p>Carte : **** {{ $paiement->payment_last4 ?? '----' }}</p>
                    <p>Payé le : {{ $paiement->paid_at ? $paiement->paid_at->format('d/m/Y') : 'Non payé' }}</p>
                    <p>
                        Statut :
                        @if ($paiement->status === 'payé')
                            <span class="text-green-600 font-semibold">✅ Payé</span>
                        @else
                            <span class="text-red-600 font-semibold">❌ En attente</span>
                        @endif
                    </p>
                    <p>
                        Reçu :
                        @if ($paiement->stripe_payment_id)
                            <a href="https://dashboard.stripe.com/payments/{{ $paiement->stripe_payment_id }}"
                               target="_blank" class="text-blue-600 underline">Voir reçu</a>
                        @else
                            —
                        @endif
                    </p>
                </div>
            @endforeach
        </div>

        {{-- ✅ VERSION DESKTOP --}}
        <div class="hidden md:block overflow-x-auto mt-4">
            <table class="w-full bg-white shadow rounded text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="px-4 py-2 text-left">Publicité</th>
                        <th class="px-4 py-2 text-left">Montant</th>
                        <th class="px-4 py-2 text-left">Méthode</th>
                        <th class="px-4 py-2 text-left">4 derniers chiffres</th>
                        <th class="px-4 py-2 text-left">Payé le</th>
                        {{-- <th class="px-4 py-2 text-left">Statut</th>
                        <th class="px-4 py-2 text-left">Reçu</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paiements as $paiement)
                        <tr class="border-t hover:bg-gray-50">
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
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right text-base font-semibold text-gray-700">
    💶 Total payé : <span class="text-green-600">{{ number_format($totalPaiements, 2, ',', ' ') }} €</span>
</div>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}"
           class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
