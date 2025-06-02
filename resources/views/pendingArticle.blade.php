@extends('admin.layout')

@section('title', 'Articles en attente')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📄 Articles en attente de validation</h1>

    @if ($articles->isEmpty())
        <p class="text-gray-600">Aucun article en attente.</p>
    @else
        {{-- ✅ Affichage Table (Desktop) --}}
        <div class="hidden md:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full table-auto text-sm">
                <thead class="bg-pink-100 text-yellow-900 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Auteur</th>
                        <th class="px-4 py-3 text-left">Créé le</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr class="border-t hover:bg-pink-50">
                            <td class="px-4 py-2 font-semibold text-gray-800">{{ $article->title }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $article->user->name }}</td>
                            <td class="px-4 py-2 text-gray-500">{{ $article->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.articles.show', $article->id) }}" class="text-blue-600 hover:underline">Voir</a>
                                    <form action="{{ route('admin.articles.validate', $article->id) }}" method="POST" onsubmit="return confirm('Valider cet article ?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:underline">Valider</button>
                                    </form>
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ✅ Affichage Cards (Mobile) --}}
        <div class="md:hidden space-y-4">
            @foreach ($articles as $article)
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $article->title }}</h2>
                    <p class="text-sm text-gray-600">Par {{ $article->user->name }} — {{ $article->created_at->format('d/m/Y') }}</p>

                    <div class="mt-3 flex flex-wrap gap-3">
                        <a href="{{ route('admin.articles.show', $article->id) }}" class="text-blue-600 underline">Voir</a>
                        <form action="{{ route('admin.articles.validate', $article->id) }}" method="POST" onsubmit="return confirm('Valider cet article ?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-green-600 underline">Valider</button>
                        </form>
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
@endsection
