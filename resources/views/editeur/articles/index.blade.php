@extends('editeur.layout')

@section('title', 'Mes articles')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">📄 Mes articles</h1>

    @if ($articles->isEmpty())
        <p>Aucun article pour l’instant.</p>
    @else
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4">Titre</th>
                    <th class="py-2 px-4">Catégorie</th>
                    <th class="py-2 px-4">Date</th>
                    <th class="py-2 px-4">Statut</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $article->title }}</td>
                    <td class="py-2 px-4">{{ $article->category->name ?? 'Non défini' }}</td>
                    <td class="py-2 px-4">{{ $article->created_at->format('d/m/Y') }}</td>
                    <td class="py-2 px-4">
                        @if ($article->is_approved)
                            <span class="text-green-600">✔ Validé</span>
                        @else
                            <span class="text-yellow-600">⏳ En attente</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">
                        <a href="{{ route('article.show', $article->slug) }}" class="text-blue-600 hover:underline">Voir</a>
                        {{-- Ajouter modifier/supprimer si besoin --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
