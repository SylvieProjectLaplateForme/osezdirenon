@extends('layout')

@section('title', 'Commentaires à valider')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Commentaires en attente</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($commentaires as $comment)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p class="text-sm text-gray-700"><strong>Auteur:</strong> {{ $comment->author }}</p>
            <p class="mt-2">{{ $comment->content }}</p>
            <p class="text-xs text-gray-400 mt-1">Pour l’article : {{ $comment->article->title }}</p>

            <form action="{{ route('admin.comment.validate', $comment->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')
                <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">✅ Valider</button>
            </form>
        </div>
    @empty
        <p>Aucun commentaire en attente de validation.</p>
    @endforelse
@endsection
