@extends('admin.layout')

@section('title', 'Modifier Profil')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">✏️ Modifier mon Profil</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>❌ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profil.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full mt-1 p-2 border rounded bg-white">
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full mt-1 p-2 border rounded bg-white">
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between">
            <a href="{{ route('admin.profil.index') }}" class="text-blue-600 hover:underline">← Retour</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                💾 Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
