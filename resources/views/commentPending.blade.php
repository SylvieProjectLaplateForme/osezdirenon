@extends('admin.layout')

@section('title', 'Commentaires à valider')

@section('content')
    <h1 class="text-3xl font-bold text-pink-600 mb-6">🕒 Commentaires en attente de validation</h1>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($commentaires->count())
        <table class="min-w-full bg-white border rounded shadow text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Auteur</th>
                    <th class="px-4 py-2 text-left">Commentaire</th>
                    <th class="px-4 py-2 text-left">Article</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commentaires as $comment)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $comment->user->name ?? 'Utilisateur inconnu' }}</td>
                        <td class="px-4 py-2">{{ $comment->content }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('article.show', $comment->article->slug) }}" class="text-blue-600 underline">
                                {{ $comment->article->title }}
                            </a>
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            {{-- Bouton valider --}}
                            <form method="POST" action="{{ route('admin.comments.validate', $comment->id) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    ✅ Valider
                                </button>
                            </form>

                            {{-- Bouton supprimer --}}
                            <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}" class="inline" onsubmit="return confirm('Supprimer ce commentaire ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">Aucun commentaire en attente de validation.</p>
    @endif

    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
@endsection
