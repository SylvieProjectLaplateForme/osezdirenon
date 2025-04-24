@extends('layout')

@section('title', 'Soumettre une Publicité')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-md rounded p-6 mt-8">
    <h1 class="text-2xl font-bold mb-4">Soumettre une publicité</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('publicite.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Titre *</label>
            <input type="text" name="titre" value="{{ old('titre') }}" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium">Lien *</label>
            <input type="url" name="lien" value="{{ old('lien') }}" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium">Image</label>
            <input type="file" name="image" class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Date de début</label>
                <input type="date" name="date_debut" class="w-full border border-gray-300 rounded p-2">
            </div>
            <div>
                <label class="block font-medium">Date de fin</label>
                <input type="date" name="date_fin" class="w-full border border-gray-300 rounded p-2">
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1" class="mr-2">
            <label for="is_active" class="font-medium">Activer la publicité</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Envoyer
        </button>
    </form>
</div>
@endsection
