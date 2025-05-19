@extends('editeur.layout')

@section('title', 'Mes articles en attente')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Mes articles en attente de validation</h1>

    @if ($articlesEnAttente->isEmpty())
        <p>Vous n'avez aucun article en attente.</p>
    @else
        <ul class="space-y-4">
            @foreach ($articlesEnAttente as $article)
                <li class="border p-4 rounded shadow bg-yellow-100">
                    <h2 class="font-semibold">{{ $article->title }}</h2>
                    <p class="text-sm text-gray-600">Créé le : {{ $article->created_at->format('d/m/Y') }}</p>
                    <a href="{{ route('editeur.articles.show', $article->id) }}" class="text-blue-600 hover:underline">Voir l’article</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
