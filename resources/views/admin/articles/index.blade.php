@extends('admin.layout')

@section('title', 'Liste des articles')

@section('content')
@if (session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
<h1 class="text-3xl font-bold text-pink-600 mb-6">
    @if(request()->routeIs('admin.articles.valides'))
         📄 Articles validés
    @else
        📄 Liste de tous les articles
    @endif
</h1>

{{-- <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📄 Liste de tous les articles</h1> --}}

    @if ($articles->isEmpty())
        <p class="text-gray-500">Aucun article trouvé.</p>
    @else

        {{-- ✅ TABLEAU pour desktop --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                    <tr class="bg-pink-200 text-yellow-700 text-sm uppercase">
                        <th class="px-6 py-3 text-left">Titre</th>
                        <th class="px-6 py-3 text-left">Auteur</th>
                        <th class="px-6 py-3 text-left">Catégorie</th>
                        <th class="px-6 py-3 text-left">Statut</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr class="border-b text-gray-700">
                            <td class="px-6 py-4">{{ $article->title }}</td>
                            <td class="px-6 py-4">{{ $article->user->name }}</td>
                            <td class="px-6 py-4">{{ $article->category->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if ($article->is_approved)
                                    <span class="text-green-600 font-semibold">Validé</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">En attente</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                @if (!$article->is_approved)
                                    <form method="POST" action="{{ route('admin.articles.validate', $article->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:underline">Valider</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>

                                <a href="{{ route('admin.articles.show', $article->id) }}"
                                    class="text-blue-600 hover:underline">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ✅ CARTES pour mobile --}}
        <div class="md:hidden space-y-4">
            @foreach ($articles as $article)
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $article->title }}</h2>
                    <p class="text-sm text-gray-600">Auteur : <strong>{{ $article->user->name }}</strong></p>
                    <p class="text-sm text-gray-600">Catégorie : {{ $article->category->name ?? '-' }}</p>
                    <p class="text-sm">
                        Statut :
                        @if ($article->is_approved)
                            <span class="text-green-600 font-semibold">Validé</span>
                        @else
                            <span class="text-yellow-500 font-semibold">En attente</span>
                        @endif
                    </p>

                    <div class="mt-3 flex flex-wrap gap-3">
                        @if (!$article->is_approved)
                            <form method="POST" action="{{ route('admin.articles.validate', $article->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-600 underline">Valider</button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 underline">Supprimer</button>
                        </form>

                        <a href="{{ route('admin.articles.show', $article->id) }}"
                            class="text-blue-600 underline">Voir</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ✅ Pagination --}}
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
@endsection
