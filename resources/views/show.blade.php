@extends('layout')

@section('title', 'Article à valider')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ $article->title }}</h1>
    <p class="text-sm text-gray-500 mb-2">
        Écrit par <strong>{{ $article->user->name }}</strong> — Catégorie : {{ $article->category->name }}
    </p>

    <div class="prose max-w-none text-gray-800">
        {!! nl2br(e($article->content)) !!}
    </div>

    <div class="mt-6 flex justify-end gap-4">
        <form method="POST" action="{{ route('admin.article.validate', $article->id) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ✅ Valider cet article
            </button>
        </form>
        <a href="{{ route('admin.articles.pending') }}" class="text-blue-600 underline">
            ← Retour à la liste
        </a>
    </div>
</div>
@endsection

