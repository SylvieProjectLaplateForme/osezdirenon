@extends('admin.layout')

@section('title', 'Voir Profil')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">👤 Détails du profil</h1>

    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Statut :</strong> 
        @if ($user->is_active)
            <span class="text-green-600">Actif</span>
        @else
            <span class="text-red-600">Inactif</span>
        @endif
    </p>

    <div class="mt-6 flex gap-4">
        <form action="{{ route('admin.profil.toggle', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                🔁 Changer le statut
            </button>
        </form>

        <a href="{{ route('admin.profil.index') }}" class="text-blue-600 hover:underline">← Retour</a>
    </div>
</div>
@endsection