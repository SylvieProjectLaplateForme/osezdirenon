@extends('editeur.layout')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📢 Publicités Payées</h1>

    @if ($publicites->isEmpty())
        <p class="text-gray-600">Vous n'avez pas encore de publicités payées.</p>
    @else

        {{-- ✅ VERSION MOBILE --}}
        <div class="space-y-4 md:hidden">
            @foreach ($publicites as $pub)
                <div class="bg-white shadow rounded p-4 text-sm">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $pub->titre }}</h2>

                    <p class="mb-1">Lien : 
                        <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir</a>
                    </p>

                    <p class="text-gray-700">💶 Montant : 
                        <strong>{{ $pub->paiement ? number_format($pub->paiement->amount, 2, ',', ' ') . ' €' : '-' }}</strong>
                    </p>

                    <p class="text-gray-600">Payée le : 
                        {{ optional($pub->paiement?->paid_at)->format('d/m/Y') ?? '-' }}
                    </p>

                    <p class="text-gray-600">Date début : 
                        {{ $pub->date_debut ? $pub->date_debut->format('d/m/Y') : '-' }}
                    </p>

                    <p class="text-gray-600">Date fin : 
                        {{ $pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-' }}
                    </p>

                    <p class="mt-2 text-green-600 font-semibold">✔️ Publicité payée</p>
                </div>
            @endforeach

            <div class="text-right text-lg font-semibold text-gray-700">
                💶 Total payé : <span class="text-green-600">{{ number_format($totalMontant, 2, ',', ' ') }} €</span>
            </div>
        </div>

        {{-- ✅ VERSION DESKTOP --}}
        <div class="hidden md:block overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="py-3 px-4 text-left">Titre</th>
                        <th class="py-3 px-4 text-left">Lien</th>
                        <th class="py-3 px-4 text-left">Payée le</th>
                        <th class="py-3 px-4 text-left">Montant (€)</th>
                        <th class="py-3 px-4 text-left">Date début</th>
                        <th class="py-3 px-4 text-left">Date fin</th>
                        <th class="py-3 px-4 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicites as $pub)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-4 font-medium">{{ $pub->titre }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir le lien</a>
                            </td>
                            <td class="px-4 py-2">
                                {{ optional($pub->paiement?->paid_at)->format('d/m/Y') ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $pub->paiement ? number_format($pub->paiement->amount, 2, ',', ' ') : '-' }}
                            </td>
                            <td class="py-2 px-4">
                                {{ $pub->date_debut ? $pub->date_debut->format('d/m/Y') : '-' }}
                            </td>
                            <td class="py-2 px-4">
                                {{ $pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="py-2 px-4">
                                <span class="text-green-600 font-semibold">✔ Payée</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-4 text-lg font-semibold text-gray-700">
                💶 Total payé : <span class="text-green-600">{{ number_format($totalMontant, 2, ',', ' ') }} €</span>
            </div>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
