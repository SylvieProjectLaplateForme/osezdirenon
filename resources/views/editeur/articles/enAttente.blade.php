@extends('editeur.layout')

@section('title', 'Mes articles en attente')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">🕓 Articles en attente de validation</h1>

    @if ($articlesEnAttente->isEmpty())
        <p class="text-gray-600">Vous n'avez aucun article en attente.</p>
    @else

        {{-- ✅ VERSION MOBILE --}}
        <div class="space-y-4 md:hidden">
    @foreach ($articlesEnAttente as $article)
        <div class="bg-yellow-50 border border-yellow-200 shadow rounded p-4 text-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $article->title }}</h2>
            <p class="text-gray-600 mb-2">Créé le : {{ $article->created_at->format('d/m/Y') }}</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('editeur.articles.show', $article->id) }}" class="text-blue-600 hover:underline">Voir l’article</a>
                <form action="{{ route('editeur.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach
</div>


        {{-- ✅ VERSION DESKTOP --}}
        <div class="hidden md:block overflow-x-auto mt-4">
    <table class="w-full bg-white shadow rounded text-sm">
        <thead>
            <tr class="bg-pink-100 text-pink-800">
                <th class="px-4 py-3 text-left">Titre</th>
                <th class="px-4 py-3 text-left">Créé le</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($articlesEnAttente as $article)
                <tr class="border-t hover:bg-yellow-50">
                    <td class="px-4 py-2 font-semibold text-gray-800">{{ $article->title }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $article->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('editeur.articles.show', $article->id) }}" class="text-blue-600 hover:underline">Voir</a>
                            <form action="{{ route('editeur.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    @endif

    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}"
           class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
