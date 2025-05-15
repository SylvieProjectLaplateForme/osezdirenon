@extends('admin.layout')

@section('title', 'Détail de l’article')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

    <p class="text-sm text-gray-500 mb-4">
        Publié par <strong>{{ $article->user->name ?? 'Inconnu' }}</strong>
        le {{ $article->created_at->format('d/m/Y') }}
    </p>

    @if ($article->image)
        <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" class="mb-6 rounded shadow w-full">
    @endif

    <div class="prose">
        {!! nl2br(e($article->content)) !!}
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.articles.index') }}" class="inline-block text-blue-600 hover:underline">
            ← Retour à la liste des articles
        </a>
    </div>
</div>
@endsection
