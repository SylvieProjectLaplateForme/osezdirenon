@extends('editeur.layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">✏️ Modifier l'article</h1>

    <form method="POST" action="{{ route('editeur.articles.update', $article->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Titre</label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Catégorie</label>
            <select name="category_id" class="w-full border p-2 rounded">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $article->category_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Contenu</label>
            <textarea name="content" class="w-full border p-2 rounded" rows="8">{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label>Image (optionnelle)</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">💾 Enregistrer</button>
    </form>
    
</div>

@endsection
