@extends('layout')

@section('title', 'Paiement réussi')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow text-center">
    <h1 class="text-3xl font-bold text-green-600 mb-4">✅ Paiement effectué avec succès</h1>

    <p class="text-gray-700 text-lg mb-6">
        Merci pour votre confiance ! Votre publicité <strong>"{{ $publicite->titre }}"</strong> sera affichée très bientôt.
    </p>

    @if ($publicite->image)
        <img src="{{ asset('storage/' . $publicite->image) }}" alt="Image publicité"
             class="w-48 h-48 mx-auto object-contain rounded shadow mb-4">
    @endif

    <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Retour à l’accueil
    </a>
</div>
@endsection
