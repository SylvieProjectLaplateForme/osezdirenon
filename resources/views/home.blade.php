@extends('layout')

@section('title', 'Osez dire Non')

@section('content')

{{-- ✅ HERO avec titre --}}
<div class="text-center py-5 bg-pink-50 shadow-sm mb-5">
    <h1 class="text-4xl font-serif text-pink-700 font-bold">Osez Dire Non</h1>
    <p class="text-gray-600 mt-2 text-sm">Le blog qui vous donne la parole</p>
</div>

{{-- 🔍 Barre de recherche par catégorie --}}
<div class="bg-white rounded-lg shadow p-4 mb-10 max-w-4xl mx-auto">
    <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4 items-center justify-center">
        <div class="relative w-full md:w-1/2">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Rechercher un article..."
                   class="w-full border border-gray-300 rounded-full py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-pink-400" />
            <span class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-400">
                🔍
            </span>
        </div>
        <select name="category" class="w-full md:w-1/3 border border-gray-300 rounded-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
            <option value="">Toutes les catégories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        <button type="submit"
                class="bg-pink-600 text-white rounded-full px-6 py-2 hover:bg-pink-700 transition">
            Rechercher
        </button>
    </form>
</div>

{{-- ✅ Grille d’articles avec pub insérée après 3 articles --}}
@if ($articles->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($articles as $article)
            {{-- ✅ Article --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                <div class="overflow-hidden rounded-t-lg">
                    <img 
                        src="{{ asset($article->image ? 'storage/' . $article->image : 'storage/articles/default.jpg') }}" 
                        alt="{{ $article->title }}" 
                        class="w-full h-48 object-cover transform transition duration-500 hover:scale-110">
                </div>
                <div class="p-6 flex flex-col justify-between flex-1">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">
                        {{ $article->title }}
                    </h3>
                    <p class="text-sm text-gray-600 mb-2">
                        Publié le {{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}
                    </p>
                    <div class="flex justify-between items-center mt-2">
                        {{-- 🟣 Catégorie --}}
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $article->category->color_class }}">
                            {{ $article->category->name }}
                        </span>
                    
                        {{-- 💬 Commentaires --}}
                        <span class="flex items-center text-sm text-gray-600 gap-1">
                            {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-6l-4 4v-4H7a2 2 0 01-2-2v-2" />
                            </svg> --}}
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 3.866-3.582 7-8 7a8.596 8.596 0 01-3.5-.75L3 21l1.75-4.25A7.964 7.964 0 013 12c0-3.866 3.582-7 8-7s8 3.134 8 7z" />
                              </svg>
                              
                            <span class="font-medium">{{ $article->comments->count() }}</span>
                        </span>
                    </div>
                    
                    <div class="text-gray-800 mb-4">
                        {!! \Illuminate\Support\Str::limit($article->content, 120) !!}
                    </div>
                    <a href="{{ route('article.show', ['slug' => $article->slug]) }}"
                       class="text-blue-600 hover:underline font-semibold mt-auto">
                        Lire la suite →
                    </a>
                </div>
            </div>

            {{-- 🎀 Publicité UNE SEULE FOIS après 3e article --}}
            @if ($loop->iteration === 3)
                <div class="col-span-full">
                    @include('carrousselPub')
                </div>
            @endif
        @endforeach
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
@else
    <p class="text-center text-gray-500">Aucun article trouvé.</p>
@endif

@endsection
