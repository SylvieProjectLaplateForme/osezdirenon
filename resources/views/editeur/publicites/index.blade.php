@extends('editeur.layout') 

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Mes publicités</h1>

    {{-- Bouton de création --}}
    <a href="{{ route('editeur.publicites.create') }}" class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        ➕ Créer une publicité
    </a>

    {{-- Liste des pubs --}}
    @forelse ($publicites as $pub)
        <div class="bg-white rounded shadow p-4 mb-4">
            <h2 class="text-xl font-semibold">{{ $pub->titre }}</h2>
            <p class="text-sm text-gray-600">Lien : 
                <a href="{{ $pub->lien }}" class="text-blue-600 underline" target="_blank">{{ $pub->lien }}</a>
            </p>
            <p class="text-sm mt-2">
                Statut :
                @if (!$pub->is_approved)
                    <span class="text-yellow-500 font-semibold">En attente de validation</span>
                @elseif ($pub->is_approved && !$pub->paid)
                    <span class="text-orange-500 font-semibold">Validée - Paiement en attente</span>
                    <form action="{{ route('stripe.checkout', $pub->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Payer</button>
                    </form>
                @else
                    <span class="text-green-600 font-semibold">Payée</span>
                @endif
            </p>
        </div>
    @empty
        <p class="text-gray-500">Aucune publicité enregistrée pour le moment.</p>
    @endforelse
</div>
@endsection