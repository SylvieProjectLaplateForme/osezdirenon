@extends('layout')

@section('title', 'Dashboard Éditeur')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tableau de bord - {{ Auth::user()->name }}</h1>


    {{-- Message flash --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bouton pour créer un article --}}
    <div class="mb-6">
        <a href="{{ route('articles.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block">
            ➕ Ajouter un article
        </a>
    </div>

    {{-- Liste des articles --}}
    @if($articles->isEmpty())
        <p class="text-gray-500">Vous n’avez pas encore rédigé d’article.</p>
    @else
        <ul class="space-y-4">
            @foreach ($articles as $article)
                <li class="bg-white shadow p-4 rounded">
                    <h2 class="text-lg font-bold text-blue-700">{{ $article->title }}</h2>
                    <p class="text-sm text-gray-500">
                        Catégorie :
                        <span class="font-semibold {{ $article->category->color_class }}">
                            {{ $article->category->name }}
                        </span> |
                        Créé le {{ $article->created_at->format('d/m/Y') }}
                    </p>

                    @if ($article->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $article->image) }}"
                                 alt="Image"
                                 class="w-48 rounded shadow">
                        </div>
                    @endif

                    <p class="mt-2">
                        <strong>Statut :</strong>
                        @if($article->is_approved)
                            <span class="text-green-600 font-semibold">✅ Validé</span>
                        @else
                            <span class="text-yellow-600 font-semibold">🕒 En attente</span>
                        @endif
                    </p>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
