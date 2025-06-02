@extends('editeur.layout')

@section('title', 'Commentaires en attente')

@section('content')
<h1 class="text-2xl font-bold mb-6">🕒 Commentaires en attente</h1>

@if ($commentaires->isEmpty())
    <p>Aucun commentaire en attente.</p>
@else
    <ul class="space-y-4">
        @foreach ($commentaires as $commentaire)
            <li class="p-4 border rounded bg-white shadow">
                <p class="text-sm text-gray-600">Sur l’article : <strong>{{ $commentaire->article->title }}</strong></p>
                <p class="mt-2">{{ $commentaire->content }}</p>
                <p class="text-sm text-gray-500 mt-1">Posté le {{ $commentaire->created_at->format('d/m/Y à H:i') }}</p>
            </li>
        @endforeach
    </ul>
@endif

<a href="{{ route('editeur.dashboard') }}" class="inline-block mt-6 text-blue-600 hover:underline">← Retour au dashboard</a>
@endsection
