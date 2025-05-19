
@extends('layout')

@section('title', $article->title)

@section('content')
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif
<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    {{-- 📰 Contenu principal --}}
    <div class="lg:col-span-2">
        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

        {{-- ✅ Catégorie et auteur --}}
        <p class="text-sm text-gray-600 mb-2">
            Par <strong>{{ $article->user->name ?? 'Auteur inconnu' }}</strong>
            le {{ $article->created_at->format('d/m/Y') }}
        </p>

        {{-- ✅ Image --}}
        @if($article->image)
        <div class="mb-6">
            <img 
                src="{{ asset('storage/' . $article->image) }}" 
                alt="Image de l'article"
                class="mx-auto block max-w-full rounded-lg shadow-md"
            >
        </div>
        @endif

        {{-- ✅ Contenu --}}
        <div class="prose max-w-none text-gray-800">
            {!! nl2br(e($article->content)) !!}
        </div>
        @if(!$article->is_approved)
    <div class="mt-6">
        <a href="{{ route('editeur.articles.edit', $article->id) }}"
           class="inline-block bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-600">
            ✏️ Modifier l'article
        </a>
    </div>
@endif

        {{-- ✅ Commentaires approuvés --}}
        <h2 class="text-xl font-semibold mt-10 mb-4">Commentaires</h2>

        @forelse ($article->comments as $comment)
            @if($comment->is_approved)
                <div class="border-t pt-4 mt-4">
                    <p class="text-sm text-gray-700">
                        <strong>{{ $comment->author }}</strong>
                        le {{ $comment->created_at->format('d/m/Y à H:i') }}
                    </p>
                    <p class="mt-1">{{ $comment->content }}</p>
                </div>
            @endif
        @empty
            <p>Aucun commentaire pour le moment.</p>
        @endforelse

        {{-- ✅ Formulaire de commentaire --}}
        <h3 class="text-lg font-semibold mt-10 mb-4">Laisser un commentaire</h3>

        <form method="POST" action="{{ route('comment.store') }}" class="bg-white p-4 rounded shadow">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">

            <div class="mb-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Votre nom</label>
                <input type="text" name="author" id="author" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Votre commentaire</label>
                <textarea name="content" id="content" rows="4" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
        </form>
    </div>

    {{-- 📚 Articles similaires --}}
    <aside class="space-y-6">
        <h3 class="text-xl font-semibold text-pink-600 mb-4">D'autres articles similaires</h3>

        @foreach($similaires as $similaire)
            <div class="border-b pb-4">
                <a href="{{ route('article.show', $similaire->slug) }}">
                    <img src="{{ asset('storage/' . ($similaire->image ?? 'articles/default.jpg')) }}" class="rounded mb-2">
                    <p class="text-sm text-pink-600">{{ $similaire->category->name }} | {{ $similaire->created_at->format('d/m/Y') }}</p>
                    <h4 class="font-bold hover:text-pink-500">{{ $similaire->title }}</h4>
                </a>
            </div>
        @endforeach
    </aside>
</div>
@endsection
