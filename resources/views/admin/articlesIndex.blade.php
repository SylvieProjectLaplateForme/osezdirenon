@extends('admin.layout')

@section('title', 'Liste des articles')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">📄 Tous les articles en attente</h1>

    @if($articles->isEmpty())
        <p class="text-gray-500">Aucun article trouvé.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <th class="px-6 py-3 text-left">Titre</th>
                        <th class="px-6 py-3 text-left">Auteur</th>
                        <th class="px-6 py-3 text-left">Catégorie</th>
                        <th class="px-6 py-3 text-left">Statut</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr class="border-b text-gray-700">
                            <td class="px-6 py-4">{{ $article->title }}</td>
                            <td class="px-6 py-4">{{ $article->user->name }}</td>
                            <td class="px-6 py-4">{{ $article->category->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($article->is_approved)
                                    <span class="text-green-600 font-semibold">Validé</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">En attente</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                @if(!$article->is_approved)
                                    <form method="POST" action="{{ route('admin.article.validate', $article->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:underline">Valider</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.article.destroy', $article->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>

                                <a href="{{ route('admin.article.show', $article->id) }}" class="text-blue-600 hover:underline">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
@endsection
