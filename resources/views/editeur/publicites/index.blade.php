@extends('editeur.layout')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">📢 Toutes mes Publicités</h1>

    @if ($publicites->isEmpty())
        <p class="text-gray-600">Aucune publicité.</p>
    @else
        {{-- ✅ VERSION MOBILE : cartes --}}
        <div class="space-y-4 md:hidden">
            @foreach ($publicites as $pub)
                <div class="bg-white shadow rounded p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $pub->titre }}</h2>
                    <p class="text-sm mb-1">
                        Lien : <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir</a>
                    </p>
                    <p class="text-sm text-gray-600">Créée le : {{ $pub->created_at?->format('d/m/Y') ?? '-' }}</p>
                    <p class="text-sm text-gray-600">Validée le : {{ $pub->is_approved && $pub->updated_at ? $pub->updated_at->format('d/m/Y') : '-' }}</p>
                    <p class="text-sm text-gray-600">Payée le :
                        {{ $pub->paiement?->paid_at ? \Carbon\Carbon::parse($pub->paiement->paid_at)->format('d/m/Y') : '-' }}
                    </p>
                    <p class="text-sm text-gray-600">Valide jusqu’au : {{ $pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-' }}</p>
                    <p class="text-sm mt-2">
                        Statut :
                        @if ($pub->paid)
                            <span class="text-green-600 font-semibold">✔️ Payée</span>
                        @else
                            <span class="text-red-500 font-semibold">❌ Non payée</span>
                        @endif
                    </p>
                </div>
            @endforeach
        </div>

        {{-- ✅ VERSION DESKTOP : tableau --}}
        <div class="hidden md:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
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
                            <td class="px-4 py-2">{{ $pub->created_at?->format('d/m/Y') ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $pub->is_approved && $pub->updated_at ? $pub->updated_at->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-2">{{ $pub->paiement?->paid_at ? \Carbon\Carbon::parse($pub->paiement->paid_at)->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-2">{{ $pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-2">
                                @if ($pub->paid)
                                    <span class="text-green-600 font-semibold">✔️ Payée</span>
                                @else
                                    <span class="text-red-500 font-semibold">❌ Non payée</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{-- <form action="{{ route('editeur.publicites.destroy', $pub->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette publicité ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form> --}}
                            </td>
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
