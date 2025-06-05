@extends('layout')

@section('title', 'Osez dire Non')

@section('content')
@if (session('success'))
    <div class="bg-green-200 text-green-800 p-4 rounded mb-6 text-center">
        {{ session('success') }}
    </div>
@endif
{{-- ✅ HERO avec titre --}}


<div class="bg-pink-50 p-6 rounded-xl  text-center max-w-3xl mx-auto mt-8">

    

    <!-- Titre + sous-titre -->
    <div class="text-center mt-10">
    <h1 class="text-5xl md:text-6xl font-extrabold text-pink-700 tracking-wide mb-2">
        Osez Dire Non
    </h1>
    <p class="text-gray-900 text-lg font-medium italic mb-4">
        Le blog qui vous donne la parole
    </p>
</div>

     
   



<!-- Image ronde -->
    <img src="{{ asset('images/tiktok.png') }}"
         alt="Vidéo TikTok"
         class="rounded-full shadow-md w-56 h-56 object-cover mx-auto mb-4">
    <!-- Lien vidéo -->
    <a href="https://www.tiktok.com/@thedailyswile/video/7197471042485488902?is_from_webapp=1" target="_blank"
       class="text-pink-600 underline text-sm inline-flex items-center gap-1 hover:text-pink-800">
        🎬  Voir la vidéo inspirante sur TikTok
    </a>

</div>


{{-- 🔍 Barre de recherche par catégorie --}}
<div class="bg-white rounded-lg shadow p-4 mb-10 max-w-4xl mx-auto">
    <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4 items-center justify-center">
        <div class="relative w-full md:w-1/2">
            {{-- <input type="text" name="q" value="{{ request('q') }}" --}}
            <input type="text" name="search" value="{{ request('search') }}"

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
            <!-- 📰 CARD ARTICLE CLIQUABLE -->
            <a href="{{ route('article.show', ['slug' => $article->slug]) }}"
               class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1 group">
                
                <!-- Image -->
                <!-- Image -->
<div class="relative overflow-hidden">
    <x-article-image 
        :image="$article->image" 
        :alt="$article->title" 
        class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" 
    />
    
    <!-- Badge catégorie -->
    <div class="absolute top-2 left-2 bg-white bg-opacity-80 px-3 py-1 text-xs font-semibold rounded-full {{ $article->category->color_class }}">
        {{ $article->category->name }}
    </div>
</div>


                <!-- Contenu -->
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="text-xl font-bold text-gray-800 leading-tight mb-2 line-clamp-2 group-hover:underline">
                        {{ $article->title }}
                    </h3>

                    <p class="text-sm text-gray-500 mb-2">
                        Par <strong>{{ $article->user->name ?? 'Auteur inconnu' }}</strong>
                        le {{ $article->created_at->format('d/m/Y') }}
                    </p>

                    <div class="text-gray-700 text-sm flex-1 mb-4 line-clamp-3">
                        {!! \Illuminate\Support\Str::limit(strip_tags($article->content), 160) !!}
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="flex items-center text-gray-600 text-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 3.866-3.582 7-8 7a8.596 8.596 0 01-3.5-.75L3 21l1.75-4.25A7.964 7.964 0 013 12c0-3.866 3.582-7 8-7s8 3.134 8 7z" />
                            </svg>
                            <span class="font-medium">{{ $article->comments->count() }}</span>
                        </span>

                        <span class="text-pink-600 font-bold group-hover:underline">Lire →</span>
                    </div>
                </div>
            </a>

            <!-- 🎀 Publicité UNE FOIS après 3 articles -->
            @if ($loop->iteration === 3)
                <div class="col-span-full">
                    @include('carrousselPub')
                </div>
            @endif
        @endforeach
    </div>

    <!-- ✅ PAGINATION -->
    <div class="mt-8">
        {{ $articles->links() }}
    </div>
@else
    <p class="text-center text-gray-500">Aucun article trouvé.</p>
@endif


@endsection
