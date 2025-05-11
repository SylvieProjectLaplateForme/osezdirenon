@extends('admin.layout')

@section('title', 'Détail de la publicité')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow mt-10">
    <h1 class="text-2xl font-bold mb-6">Détail de la publicité</h1>

    <div class="mb-4">
        <strong class="block text-gray-700">Titre :</strong>
        <p>{{ $pub->titre }}</p>
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700">Lien :</strong>
        <a href="{{ $pub->lien }}" class="text-blue-600 underline" target="_blank">{{ $pub->lien }}</a>
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700">Créée par :</strong>
        <p>{{ $pub->user->name ?? 'Non identifié' }}</p>
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700">Statut :</strong>
        <p>
            Validée : {{ $pub->is_approved ? '✅ Oui' : '❌ Non' }}<br>
            Payée : {{ $pub->paid ? '✅ Oui' : '❌ Non' }}
        </p>
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700">Période de diffusion :</strong>
        <p>
            Du {{ $pub->date_debut ?? '—' }} au {{ $pub->date_fin ?? '—' }}
        </p>
    </div>

    @if($pub->image)
    <div class="mb-6">
        <strong class="block text-gray-700 mb-2">Image :</strong>
        <img src="{{ asset('storage/' . $pub->image) }}" alt="Image publicité" class="w-64 rounded shadow">
    </div>
    @endif

    <div class="flex gap-4 mt-6">
        @if (!$pub->is_approved)
        <form method="POST" action="{{ route('admin.publicites.valider', $pub->id) }}">
            @csrf
            @method('PUT')
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ✅ Valider
            </button>
        </form>
        @endif

        <form method="POST" action="{{ route('admin.publicites.destroy', $pub->id) }}">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                🗑️ Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
