@extends('layout')

@section('title', 'Accueil')

@section('content')

{{-- Message de succès après soumission de contact ou suppression --}}
@if (session('success'))
    <div id="success-message" class="bg-green-200 text-green-800 p-4 rounded mb-6 text-center">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            var message = document.getElementById('success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000); // Le message disparait après 3 secondes
    </script>
@endif



{{-- Formulaire de recherche --}}
<div class="mb-10 text-center">
    <form action="{{ route('home') }}" method="GET" class="flex justify-center gap-2">
        <input type="text" name="search" placeholder="Rechercher un article..." 
               class="border-2 border-blue-600 p-2 rounded w-1/2 focus:border-red-600 focus:ring-2 focus:ring-red-600" 
               value="{{ request('search') }}"/>
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Rechercher
        </button>
    </form>
</div>


{{-- Liste des articles --}}
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($articles as $article)
    <a href="{{ route('article.show', $article->slug) }}">
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">

            {{-- Image au-dessus du titre --}}
            @if ($article->image)
                <img src="{{ asset('images/' . $article->image) }}" 
                     alt="{{ $article->title }}" 
                     class="rounded mb-4 w-full h-48 object-cover shadow">
            @endif

            <h2 class="text-2xl font-bold text-blue-600 hover:underline mb-2">
                <a href="{{ route('article.show', $article->slug) }}">

                    {{ $article->title }}
                </a>
            </h2>

            <p class="text-gray-500 text-sm mb-2">
                Publié le {{ $article->created_at->format('d/m/Y') }}
            </p>

            <p class="text-gray-500 text-sm mb-2">
                Catégorie : 
                <span class="{{ $article->category->color_class ?? 'text-gray-500' }}">
                    {{ $article->category->name ?? 'Non catégorisé' }}
                </span>
            </p>

            <p class="mb-4">
                {{ Str::limit(strip_tags($article->content), 120) }}
            </p>

            {{-- Bouton "Lire la suite" --}}
            <div class="mb-2">
                <a href="{{ route('article.show', $article->slug) }}" 
                   class="text-blue-500 hover:underline font-semibold">
                    Lire la suite →
                </a>
            </div>
        </div>
    @empty
        <div class="text-center text-gray-500 col-span-3">
            Aucun article trouvé pour l’instant.
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="mt-8">
    {{ $articles->links() }}
</div>

@endsection