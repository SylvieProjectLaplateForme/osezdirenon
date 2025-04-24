@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    {{-- MESSAGE DE CONFIRMATION --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- TITRE DE L’ARTICLE --}}
    <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>
    <p class="text-sm text-gray-500 mb-6">Par <strong>{{ $article->user->name ?? 'Anonyme' }}</strong> - {{ $article->created_at->format('d/m/Y') }}</p>

    @if ($article->image)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" class="w-full rounded-lg shadow">
        </div>
    @endif

    {{-- CONTENU DE L’ARTICLE --}}
    <div class="prose max-w-none mb-12 bg-white p-6 rounded shadow">
        {{-- {!! $article->content !!} --}}
       
            @foreach (explode("\n", $article->content) as $paragraph)
                @if (trim($paragraph) !== '')
                    <p>{{ $paragraph }}</p>
                @endif
            @endforeach
        </div>
        

    </div>

    {{-- COMMENTAIRES APPROUVÉS --}}
    <div class="bg-gray-50 p-6 rounded shadow mb-8">
        <h2 class="text-2xl font-semibold mb-4">💬 Commentaires</h2>

        @forelse ($article->comments->where('is_approved', 1) as $comment)
            <div class="bg-white p-4 rounded shadow mb-3">
                <p class="text-sm font-semibold text-gray-700">{{ $comment->author ?? 'Anonyme' }}</p>
                <p class="mt-1 whitespace-pre-line text-gray-800">{{ $comment->content }}</p>
                <p class="text-xs text-gray-400 text-right">Posté le {{ $comment->created_at->format('d/m/Y à H:i') }}</p>
            </div>
        @empty
            <p class="text-gray-500">Aucun commentaire validé pour le moment.</p>
        @endforelse
    </div>

    {{-- FORMULAIRE DE COMMENTAIRE --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-xl font-bold mb-4">✍️ Laisser un commentaire</h3>
        <form method="POST" action="{{ route('comment.store') }}">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">

            <div class="mb-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="author" id="author" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
        </form>
    </div>
</div>
@endsection
