@extends('editeur.layout')

@section('title', 'Créer un article')

@section('content')
    <h1 class="text-2xl font-bold mb-6">📝 Nouvel article</h1>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('editeur.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block font-semibold">Titre</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <div>
            <label for="content" class="block font-semibold">Contenu</label>
            <textarea name="content" id="content" rows="6" required class="w-full border border-gray-300 rounded p-2">{{ old('content') }}</textarea>
        </div>

        <div>
            <label for="category_id" class="block font-semibold">Catégorie</label>
            <select name="category_id" id="category_id" required class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Choisir une catégorie --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Champ image --}}
        <div>
            <label for="image" class="block font-semibold">Image à la une (optionnelle)</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Enregistrer l'article
        </button>
    </form>
@endsection
