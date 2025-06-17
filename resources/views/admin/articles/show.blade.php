{{-- @extends('admin.layout')

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
@endsection --}}

@extends('admin.layout')

@section('title', 'Détail de l’article')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-3xl font-bold mb-4">📝 {{ $article->title }}</h1>

    {{-- ✅ Infos auteur et date --}}
    <p class="text-gray-600 text-sm mb-4">
        Catégorie : <strong>{{ $article->category->name }}</strong> |
        Par <strong>{{ $article->user->name }}</strong> |
        Le {{ $article->created_at->format('d/m/Y') }}
    </p>

    {{-- ✅ Image avec composant --}}
    @if($article->image)
        <div class="mb-6">
            <x-article-image :image="$article->image" :alt="$article->title" class="rounded-lg shadow max-w-full h-auto mx-auto" />
        </div>
    @endif

    {{-- ✅ Contenu --}}
    <div class="prose max-w-none text-gray-800">
        {!! nl2br(e($article->content)) !!}
    </div>

    {{-- ✅ Boutons d’action admin --}}
    <div class="mt-8 flex flex-wrap gap-4">
        @if(!$article->is_approved)
            <form method="POST" action="{{ route('admin.articles.validate', $article->id) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    ✅ Valider l’article
                </button>
            </form>
        @endif

        <a href="{{ route('admin.articles.index') }}" class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
            ← Retour à la liste
        </a>
    </div>
</div>
@endsection
