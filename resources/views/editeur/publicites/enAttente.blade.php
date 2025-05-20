
@extends('editeur.layout')

@section('title', 'Mes publicités en attente')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">⏳ Mes publicités en attente</h1>

    @if($publicites->count())
        <ul class="space-y-4">
            @foreach($publicites as $pub)
                <li class="border p-4 rounded shadow bg-yellow-100">
                    <h2 class="font-semibold">{{ $pub->titre }}</h2>
                    <p class="text-sm text-gray-600">Soumise le {{ $pub->created_at->format('d/m/Y') }}</p>
                    <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 hover:underline">Lien vers la publicité</a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600">Aucune publicité en attente.</p>
    @endif
    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
