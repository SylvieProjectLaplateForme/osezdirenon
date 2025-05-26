@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-pink-600">✏️ Modifier l’article</h1>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Titre</label>
            <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}"
                   class="w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label for="content" class="block font-semibold mb-1">Contenu</label>
            <textarea name="content" id="content" rows="8"
                      class="w-full border border-gray-300 rounded px-4 py-2">{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block font-semibold mb-1">Catégorie</label>
            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded px-4 py-2">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $article->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-semibold mb-1">Image (optionnelle)</label>
            <input type="file" name="image" id="image" class="w-full">
            @if ($article->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $article->image) }}" class="w-32 rounded shadow">
                </div>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                💾 Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection
