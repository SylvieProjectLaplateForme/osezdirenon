@extends('admin.layout')

@section('title', 'Statistiques des paiements')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">💶 Statistiques des publicités payées</h1>

    {{-- Formulaire de filtre --}}
    <form method="GET" class="mb-6 flex flex-col md:flex-row gap-4">
        <select name="mois" class="border p-2 rounded">
            <option value="">-- Mois --</option>
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('mois') == $m ? 'selected' : '' }}>
                    {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                </option>
            @endforeach
        </select>
        <select name="annee" class="border p-2 rounded">
            <option value="">-- Année --</option>
            @foreach(range(date('Y'), date('Y') - 5) as $y)
                <option value="{{ $y }}" {{ request('annee') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrer</button>
    </form>

    {{-- Résultat --}}
    <p class="text-lg mb-4">💰 Total des paiements :
        <strong class="text-green-600">{{ number_format($total, 2, ',', ' ') }} €</strong>
    </p>

    {{-- ✅ TABLEAU pour desktop --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full border">
            <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                <tr class="bg-pink-200">
                    <th class="px-4 py-2 text-left">Publicité</th>
                    <th class="px-4 py-2 text-left">Montant</th>
                    <th class="px-4 py-2 text-left">Payée le</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $paiement->publicite->titre ?? '-' }}</td>
                        <td class="px-4 py-2">{{ number_format($paiement->amount, 2, ',', ' ') }} €</td>
                        <td class="px-4 py-2">
                            {{ $paiement->paid_at ? \Carbon\Carbon::parse($paiement->paid_at)->format('d/m/Y') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-4 py-2 text-gray-500">Aucun paiement trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ✅ CARTES pour mobile --}}
    <div class="md:hidden space-y-4">
        @forelse($paiements as $paiement)
            <div class="bg-white-50 border rounded-lg p-4 shadow">
                <h2 class="font-semibold text-gray-800">{{ $paiement->publicite->titre ?? '-' }}</h2>
                <p class="text-sm text-gray-600">💰 Montant :
                    <span class="text-green-600">{{ number_format($paiement->amount, 2, ',', ' ') }} €</span>
                </p>
                <p class="text-sm text-gray-600">📅 Payée le :
                    {{ $paiement->paid_at ? \Carbon\Carbon::parse($paiement->paid_at)->format('d/m/Y') : '-' }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">Aucun paiement trouvé.</p>
        @endforelse
    </div>
    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>

@endsection
