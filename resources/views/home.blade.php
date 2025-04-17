@extends('layout')

@section('title', 'Accueil')

@section('content')

{{-- 🔍 Champ de recherche --}}
{{-- <form method="GET" action="{{ route('home') }}" class="mb-8 text-center">
    <input type="text" name="search" placeholder="Rechercher un article..."
           value="{{ request('search') }}"
           class="border border-blue-400 px-4 py-2 rounded w-1/2 focus:outline-none focus:ring focus:border-blue-500">
    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Rechercher
    </button>
</form> --}}

{{-- 🟡 Filtre par Catégorie --}}
@php
    $categoryColors = [
        'Travail' => 'bg-yellow-500 text-white',
        'École' => 'bg-blue-500 text-white',
        'Famille' => 'bg-pink-500 text-white',
        'Couple' => 'bg-red-500 text-white',
        'Société' => 'bg-green-500 text-white',
        'Développement Personnel' => 'bg-purple-600 text-white',
    ];
@endphp
<div class="flex flex-wrap justify-center gap-2 mb-8">
    {{-- Bouton "Toutes les catégories" --}}
    <a href="{{ route('home') }}"
       class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition ring-2 ring-black">
        Toutes
    </a>

    {{-- Boutons par catégorie --}}
    @foreach ($categories as $category)
        <a href="{{ route('home', ['category' => $category->id]) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold hover:scale-105 transition {{ $categoryColors[$category->name] ?? 'bg-gray-300 text-black' }}">
            {{ $category->name }}
        </a>
    @endforeach
    </div>


{{-- ✅ Grille d’articles --}}
@if ($articles->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($articles as $article)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">

                <div class="p-6 flex flex-col justify-between flex-1">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">
                        {{ $article->title }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-2">
                        Publié le {{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}
                    </p>

                    {{-- ✅ Badge de catégorie avec couleur dynamique --}}
                    <span class="text-sm font-semibold px-3 py-1 rounded-full {{ $article->category->color_class }}">
                        {{ $article->category->name }}
                    </span>
                    
                    

                    <div class="text-gray-800 mb-4">
                        {!! \Illuminate\Support\Str::limit($article->content, 120) !!}
                    </div>
                    
                    <a href="{{ route('article.show', ['slug' => $article->slug]) }}"
                       class="text-blue-600 hover:underline font-semibold mt-auto">
                        Lire la suite →
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination si nécessaire --}}
    <div class="mt-8">
        {{ $articles->links() }}
    </div>

@else
    <p class="text-center text-gray-500">Aucun article trouvé.</p>
@endif

@endsection
