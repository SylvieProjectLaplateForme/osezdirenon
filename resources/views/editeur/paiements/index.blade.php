@extends('editeur.layout')

@section('title', 'Mes paiements')

@section('content')
<h1 class="text-2xl font-bold mb-6">Mes paiements</h1>

@if ($paiements->isEmpty())
    <p>Aucun paiement trouvé.</p>
@else
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Référence</th>
                <th class="px-4 py-2">Montant</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Statut</th>
                <th class="px-4 py-2">Reçu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paiements as $paiement)
                <tr>
                    <td class="px-4 py-2">{{ $paiement->reference }}</td>
                    <td class="px-4 py-2">{{ number_format($paiement->montant / 100, 2) }} €</td>
                    <td class="px-4 py-2">{{ $paiement->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $paiement->status }}</td>
                    <td class="px-4 py-2">
                        @if ($paiement->stripe_receipt_url)
                            <a href="{{ $paiement->stripe_receipt_url }}" target="_blank" class="text-blue-600 underline">Voir reçu</a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
