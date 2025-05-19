@extends('editeur.layout') 

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">📢 Publicités Payées</h1>

    @if($publicites->isEmpty())
        <p class="text-gray-600">Aucune publicité payée.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <th class="px-4 py-3 text-left">Titre</th>
                    <th class="px-4 py-3 text-left">Lien</th>
                    <th class="px-4 py-3 text-left">Créée le</th>
                    <th class="px-4 py-3 text-left">Validée le</th>
                    <th class="px-4 py-3 text-left">Payée le</th>
                    <th class="px-4 py-3 text-left">Valide jusqu’au</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publicites as $pub)
                <tr class="border-b text-gray-800">
                    <td class="px-4 py-2 font-semibold">{{ $pub->titre }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir le lien</a>
                    </td>
                    <td class="px-4 py-2">
                        {{ $pub->created_at ? $pub->created_at->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $pub->is_approved && $pub->updated_at ? $pub->updated_at->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-2">
                        @php
                            $paiement = $pub->paiement ?? null;
                        @endphp
                        {{ $paiement && $paiement->paid_at ? \Carbon\Carbon::parse($paiement->paid_at)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-2">
                        @if ($pub->paid)
                            <span class="text-green-600 font-semibold">✔️ Payée</span>
                        @else
                            <span class="text-red-500 font-semibold">❌ Non payée</span>
                        @endif
                    </td>
                    {{-- <td class="px-4 py-2">
                        <form action="{{ route('editeur.publicites.destroy', $pub->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette publicité ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection