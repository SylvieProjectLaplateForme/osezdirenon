@extends('admin.layout')

@section('title', 'Mon profil')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    
    <h1 class="text-2xl font-bold mb-6">👤 Modifier mon profil</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('admin.profil.update', $user->id) }}">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block font-medium">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="input-field">
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="input-field">
        </div>

        {{-- Bouton enregistrer --}}
        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                💾 Enregistrer
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .input-field {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        background-color: #f9fafb;
    }
</style>
@endpush
@endsection
