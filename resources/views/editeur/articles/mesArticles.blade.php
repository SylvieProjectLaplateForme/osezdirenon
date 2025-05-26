@extends('editeur.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📝 Mes Articles</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($articles->isEmpty())
    <p class="text-gray-500">Aucun article publié.</p>
@else

    <!-- ✅ VERSION MOBILE : cartes -->
    <div class="space-y-4 md:hidden">
        @foreach ($articles as $article)
            <div class="bg-white shadow rounded p-4">
                <h2 class="font-bold text-lg text-gray-800 mb-1">{{ $article->title }}</h2>
                <p class="text-sm text-gray-600">Catégorie : {{ $article->category->name }}</p>
                <p class="text-sm text-gray-600">Créé le : {{ $article->created_at->format('d/m/Y') }}</p>
                <p class="text-sm mb-2">
                    Statut :
                    @if ($article->is_approved)
                        <span class="text-green-600 font-semibold">✅ Validé</span>
                    @else
                        <span class="text-yellow-600 font-semibold">🕓 En attente</span>
                    @endif
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('editeur.articles.show', $article->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    @if (! $article->is_approved)
                        <a href="{{ route('editeur.articles.edit', $article->id) }}" class="text-indigo-600 hover:underline">Modifier</a>
                        <form action="{{ route('editeur.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- ✅ VERSION DESKTOP : tableau -->
    <div class="hidden md:block overflow-x-auto bg-white shadow rounded-lg mt-4">
        <table class="w-full table-auto text-sm min-w-[600px]">
            <thead class="bg-pink-100 text-pink-800">
                <tr>
                    <th class="px-4 py-2 text-left">Titre</th>
                    <th class="px-4 py-2 text-left">Catégorie</th>
                    <th class="px-4 py-2 text-left">Créé le</th>
                    <th class="px-4 py-2 text-left">Statut</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="border-t">
                        <td class="px-4 py-2 font-semibold text-gray-800">
                            {{ $article->title }}
                        </td>
                        <td class="px-4 py-2 text-gray-600">
                            {{ $article->category->name }}
                        </td>
                        <td class="px-4 py-2 text-gray-600">
                            {{ $article->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2">
                            @if ($article->is_approved)
                                <span class="text-green-600 font-semibold">✅ Validé</span>
                            @else
                                <span class="text-yellow-600 font-semibold">🕓 En attente</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('editeur.articles.show', $article->id) }}" class="text-blue-600 hover:underline">Voir</a>
                                @if (! $article->is_approved)
                                    <a href="{{ route('editeur.articles.edit', $article->id) }}" class="text-indigo-600 hover:underline">Modifier</a>
                                    <form action="{{ route('editeur.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endif


    <!-- ✅ Retour tableau de bord -->
    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
