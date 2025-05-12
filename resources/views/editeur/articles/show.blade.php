@extends('editeur.layout')

@section('title', $article->title)

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>
        <p class="text-sm text-gray-600 mb-2">Créé le {{ $article->created_at->format('d/m/Y') }}</p>

        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" class="mb-4 rounded shadow" alt="Image">
        @endif

        <div class="prose max-w-none">
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>
@endsection
