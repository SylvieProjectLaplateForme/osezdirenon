@extends('layout')

@section('title', 'Dashboard Admin')


@section('content')
    <h1 class="text-2xl font-bold mb-6">Tableau de bord - Admin</h1>

    {{-- Message flash --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    @php
    $filter = $filter ?? null;
@endphp
    {{-- 🔍 Filtres --}}
    <div class="flex gap-4 mb-6">
        <a href="{{ route('admin.dashboard') }}"
           class="px-4 py-2 rounded {{ $filter === null ? 'bg-black text-white' : 'bg-gray-200 text-black' }}">
            Tous
        </a>
        <a href="{{ route('admin.dashboard', 'approved') }}"
           class="px-4 py-2 rounded {{ $filter === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-200 text-black' }}">
            Validés
        </a>
        <a href="{{ route('admin.dashboard', 'pending') }}"
           class="px-4 py-2 rounded {{ $filter === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-black' }}">
            En attente
        </a>
    </div>

    {{-- 🔽 Liste des articles --}}
    <ul class="space-y-4">
        @forelse ($articles as $article)
            <li class="bg-white p-4 rounded shadow flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-blue-700">{{ $article->title }}</h3>
                    <p class="text-sm text-gray-600">
                        Catégorie : 
                        {{-- <span class="font-semibold {{ $article->category->color() }}">
                            {{ $article->category->name }}
                        </span> -  --}}
                        <span class="font-semibold {{ $article->category->color_class }}">
                            {{ $article->category->name }}
                        </span>
                        
                        Publié le {{ $article->created_at->format('d/m/Y') }}
                    </p>
                </div>

                {{-- Bouton de validation si non validé --}}
                <div class="flex gap-2">
                @if (!$article->is_approved)
                    <form method="POST" action="{{ route('admin.articles.validate', $article->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Valider
                        </button>
                    </form>
                @else
                    <span class="text-green-600 font-bold">Validé</span>
                @endif
                {{-- Formulaire de suppression --}}
<form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}"
    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');"
    class="ml-4">
  @csrf
  @method('DELETE')
  <button class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 text-sm">
      Supprimer
  </button>
</form>
</div>

            </li>
        @empty
            <p class="text-center text-gray-500">Aucun article trouvé pour ce filtre.</p>
        @endforelse
    </ul>
@endsection
