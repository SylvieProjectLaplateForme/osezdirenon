@extends('editeur.layout')

@section('title', 'Paiement annulé')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow text-center">
    <h1 class="text-2xl font-bold text-red-600 mb-4">❌ Paiement annulé</h1>

    <p class="text-gray-700 mb-6">Le paiement n’a pas été effectué. Vous pouvez réessayer à tout moment.</p>

    <a href="{{ route('home') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">
        Retour à l’accueil
    </a>
</div>
@endsection
