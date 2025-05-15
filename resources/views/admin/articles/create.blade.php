@extends('admin.layout')

@section('title', 'Créer un article')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Créer un article</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Titre --}}
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Titre</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                   class="w-full border px-4 py-2 rounded" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Catégorie --}}
        <div class="mb-4">
            <label for="category_id" class="block font-semibold mb-1">Catégorie</label>
            <select name="category_id" id="category_id"
                    class="w-full border px-4 py-2 rounded" required>
                <option value="">-- Choisir une catégorie --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Contenu --}}
        <div class="mb-4">
            <label for="content" class="block font-semibold mb-1">Contenu</label>
            <textarea name="content" id="content" rows="6"
                      class="w-full border px-4 py-2 rounded" required>{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-4">
            <label for="image" class="block font-semibold mb-1">Image</label>
            <input type="file" name="image" id="image"
                   class="w-full border px-4 py-2 rounded">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bouton de soumission --}}
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
            🚀 Publier l’article
        </button>
    </form>
</div>
@endsection
