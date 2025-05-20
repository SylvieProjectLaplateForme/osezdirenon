@extends('editeur.layout')

@section('title', 'Publicités à payer')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">💳 Publicités en attente de paiement</h1>

    @if($publicites->count())
        <ul class="space-y-4">
            @foreach($publicites as $pub)
                <li class="border p-4 rounded shadow bg-blue-50">
                    <h2 class="font-semibold">{{ $pub->titre }}</h2>
                    <p class="text-sm text-gray-600">Validée le {{ $pub->updated_at->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-600">
                        <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir la publicité</a>
                    </p>

                    <form action="{{ route('stripe.checkout', $pub->id) }}" method="POST" class="inline-block mt-2">
    @csrf
    <button type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        💳 Payer maintenant
    </button>
</form>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600">Aucune publicité en attente de paiement.</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="text-blue-600 hover:underline">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
