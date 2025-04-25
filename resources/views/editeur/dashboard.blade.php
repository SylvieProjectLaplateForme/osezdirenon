@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Bienvenue dans votre Espace {{ Auth::user()->name }} !</h1>
    <div class="mb-6">
        <a href="{{ route('articles.create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition duration-200">
            ✍️ Créer un nouvel article
        </a>
    </div>
    <h2 class="text-xl font-semibold mb-2 flex items-center gap-2">🗂️ Mes Articles</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
                <!-- Articles validés -->
                <div class="card border-l-4 border-green-500 shadow p-4 bg-white rounded">
                    <h3 class="text-sm text-gray-500 font-semibold uppercase">Articles validés</h3>
                    <p class="text-2xl font-bold text-green-600 mt-2">{{ $articlesValides->count() }}</p>
                    <a href="{{ route('articles.index') }}" class="text-sm text-blue-600 hover:underline mt-1 block">Voir</a>
                </div>
        
                <!-- Articles en attente -->
                <div class="card border-l-4 border-yellow-500 shadow p-4 bg-white rounded">
                    <h3 class="text-sm text-gray-500 font-semibold uppercase">Articles en attente</h3>
                    <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $articlesEnAttente->count() }}</p>
                    <a href="{{ route('articles.index') }}" class="text-sm text-blue-600 hover:underline mt-1 block">Voir</a>
                </div>
            </div>
        
            <h2 class="text-xl font-bold mb-4">📢 Mes Publicités</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Pubs validées -->
                <div class="card border-l-4 border-green-500 shadow p-4 bg-white rounded">
                    <h3 class="text-sm text-gray-500 font-semibold uppercase">Pubs validées</h3>
                    <p class="text-2xl font-bold text-green-600 mt-2">{{ $pubsValidees->count() }}</p>
                    <a href="{{ route('publicites.index') }}" class="text-sm text-blue-600 hover:underline mt-1 block">Voir</a>
                </div>
        
                <!-- Pubs en attente -->
                <div class="card border-l-4 border-yellow-500 shadow p-4 bg-white rounded">
                    <h3 class="text-sm text-gray-500 font-semibold uppercase">Pubs en attente</h3>
                    <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $pubsAttente->count() }}</p>
                    <a href="{{ route('publicites.index') }}" class="text-sm text-blue-600 hover:underline mt-1 block">Voir</a>
                </div>
        
                <!-- Pubs payées -->
                <div class="card border-l-4 border-indigo-500 shadow p-4 bg-white rounded">
                    <h3 class="text-sm text-gray-500 font-semibold uppercase">Pubs payées</h3>
                    <p class="text-2xl font-bold text-indigo-600 mt-2">{{ $pubsPayees->count() }}</p>
                    <a href="{{ route('paiements.index') }}" class="text-sm text-blue-600 hover:underline mt-1 block">Voir</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

