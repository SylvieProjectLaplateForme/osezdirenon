{{-- @extends('layout')

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
@endsection --}}
@extends('layout')

@section('title', $article->title)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    {{-- 📰 Contenu principal --}}
    <div class="lg:col-span-2">
        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>
        <p class="text-sm text-gray-500 mb-6">
            {{ $article->category->name }} |
            {{ $article->created_at->format('d/m/Y') }}
        </p>

        {{-- @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" class="mb-4 rounded shadow" alt="Image">
        @endif --}}
        <div class="mb-6">
            <img 
                src="{{ asset('storage/' . $article->image) }}" 
                alt="Image de l'article"
                class="mx-auto block max-w-full rounded-lg shadow-md"
            >
        </div>

        <div class="prose max-w-none text-gray-800">
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>

    {{-- 📚 Articles similaires --}}
    <aside class="space-y-6">
        <h3 class="text-xl font-semibold text-pink-600 mb-4">d'autres articles similaires</h3>

        @foreach($similaires as $similaire)
            <div class="border-b pb-4">
                <a href="{{ route('article.show', $similaire->slug) }}">
                    <img src="{{ asset('storage/' . ($similaire->image ?? 'articles/default.jpg')) }}" class="rounded mb-2">
                    <p class="text-sm text-pink-600">{{ $similaire->category->name }} | {{ $article->created_at->format('d/m/Y') }}</p>
                    <h4 class="font-bold hover:text-pink-500">{{ $similaire->title }}</h4>
                </a>
            </div>
        @endforeach
    </aside>
</div>
@endsection

