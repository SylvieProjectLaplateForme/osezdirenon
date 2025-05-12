@extends('editeur.layout')

@section('title', 'Dashboard Éditeur')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Bienvenue, {{ Auth::user()->name }}</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes articles</h2>
        <p class="text-2xl font-bold">{{ $totalArticles ?? 0 }}</p>
        <a href="{{ route('editeur.articles.index') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>

    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Articles en attente</h2>
        <p class="text-2xl font-bold">{{ $attenteArticles ?? 0 }}</p>
        <a href="{{ route('editeur.articles.enAttente') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes Publicités </h2>
        <p class="text-2xl font-bold">{{ $totalPublicites ?? 0 }}</p>
        <a href="{{ route('editeur.publicites.index') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>
    
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes paiements</h2>
        <p class="text-2xl font-bold">{{ $paiements ?? 0 }}</p>
        <a href="{{ route('editeur.paiements.index') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>
</div>

{{-- Tableau de derniers articles --}}
<div class="bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Derniers articles</h2>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="text-left px-4 py-2 border-b">Titre</th>
                <th class="text-left px-4 py-2 border-b">Statut</th>
                <th class="text-left px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td class="px-4 py-2 border-t">{{ $article->title }}</td>
                    <td class="px-4 py-2 border-t">
                        @if ($article->is_approved)
                            <span class="text-green-600">✔ Validé</span>
                        @else
                            <span class="text-yellow-600">⏳ En attente</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-t">
                        <a href="{{ route('article.show', $article->slug) }}" class="text-blue-600 hover:underline">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">Aucun article pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
