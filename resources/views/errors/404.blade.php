@extends('layout')

@section('title', 'Page non trouvée')

@section('content')
<div class="min-h-screen bg-pink-50 flex items-center justify-center px-4">
    <div class="max-w-xl w-full text-center mx-auto py-12">

        {{-- Ton image si tu veux l’ajouter --}}
        {{-- <img src="{{ asset('images/erreur-404.png') }}" alt="404" class="mx-auto w-40 mb-6"> --}}

        <h1 class="text-7xl font-extrabold text-pink-600 mb-4">404</h1>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Oups... Cette page n'existe pas.</h2>

        <p class="text-gray-600 mb-6">
            La page que vous cherchez a peut-être été supprimée, renommée ou n’a jamais existé.
        </p>

        <a href="{{ route('home') }}"
           class="inline-block px-6 py-3 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-700 transition text-sm">
            ⬅️ Retour à l’accueil
        </a>
    </div>
</div>
@endsection
