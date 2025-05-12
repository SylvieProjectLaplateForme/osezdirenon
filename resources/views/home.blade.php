@extends('layout')

@section('title', 'Accueil')

@section('content')
@if (session('success'))
    <div class="...">
        {{ session('success') }}
    </div>
@endif
<div class="container mt-4">
    <div class="flex justify-center items-center mt-2">
        <div class="relative group flex items-center space-x-2 text-sm text-gray-700">
            <span>Publicités sponsorisées</span>
    
            <!-- Icône info -->
            <div class="relative">
                <svg class="w-4 h-4 text-blue-500 cursor-pointer" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 7h2v2H9V7zm1-5a9 9 0 100 18A9 9 0 0010 2zm0 16a7 7 0 110-14 7 7 0 010 14z"/>
                </svg>
    
                <!-- Tooltip au survol -->
                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-52 px-3 py-2 
                            text-white bg-gray-800 text-xs rounded shadow-md opacity-0 group-hover:opacity-100 
                            transition-opacity duration-300 z-50 text-center">
                    Ces publicités sont fournies par nos partenaires. <br>
                    <a href="{{ route('editeur.publicites.create') }}" class="underline text-blue-400 hover:text-blue-300">
                        Proposer la vôtre
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Carrousel des publicités --}}
    @php
$publicites = \App\Models\Publicite::where('is_approved', true)
    ->where('paid', true)
    ->where(function($q){
        $q->whereNull('date_debut')->orWhere('date_debut', '<=', now());
    })
    ->where(function($q){
        $q->whereNull('date_fin')->orWhere('date_fin', '>=', now());
    })
    ->latest()
    ->take(6)
    ->get()
    ->chunk(3);
@endphp

    
    @if($publicites->count())
<div id="carouselPub" class="relative w-full overflow-hidden mb-6">
    <div class="flex transition-transform duration-700 ease-in-out" id="carouselItems">
        @foreach($publicites as $group)
            <div class="min-w-full flex justify-around items-center bg-yellow-100 p-6 gap-4">
                @foreach($group as $pub)
                    <div class="flex flex-col items-center w-1/3 text-center bg-white rounded shadow p-3">
                        <a href="{{ $pub->lien }}" target="_blank">
                            @if($pub->image)
                                <img src="{{ asset('storage/' . $pub->image) }}" alt="{{ $pub->titre }}" class="h-24 object-contain mx-auto mb-2">
                            @endif
                            <p class="font-semibold text-gray-800">{{ $pub->titre }}</p>
                        </a>
                        <a href="{{ $pub->lien }}" target="_blank"
                           class="mt-2 inline-block bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 text-sm">
                            Voir
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<script>
    const carousel = document.getElementById('carouselItems');
    let index = 0;
    const total = {{ $publicites->count() }};

    setInterval(() => {
        index = (index + 1) % total;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }, 5000);
</script>
@endif




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
                {{-- <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover"> --}}
                {{-- <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover"> --}}
                <img 
    src="{{ asset($article->image ? 'storage/' . $article->image : 'storage/articles/default.jpg') }}" 
    alt="{{ $article->title }}" 
    class="w-full h-48 object-cover">



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
