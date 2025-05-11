@extends('admin.layout')

@section('title', 'Mon profil')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Mon Profil</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.profil.update', $user->id) }}">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block font-medium">Nom</label>
            <div class="flex items-center gap-2">
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="input-field" disabled>
                <button type="button" onclick="enableField('name')" class="text-gray-500 hover:text-blue-600">✏️</button>
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <div class="flex items-center gap-2">
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="input-field" disabled>
                <button type="button" onclick="enableField('email')" class="text-gray-500 hover:text-blue-600">✏️</button>
            </div>
        </div>

        {{-- Changer mot de passe --}}
        <div class="mb-4">
            <label class="block font-medium">Mot de passe</label>
            <button type="button" onclick="togglePasswordFields()" class="text-sm text-blue-600 hover:underline">
                🔒 Changer mon mot de passe
            </button>
        </div>

        <div id="password-fields" class="hidden">
            <div class="mb-4">
                <input type="password" name="password" placeholder="Nouveau mot de passe" class="input-field">
            </div>
            <div class="mb-4">
                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" class="input-field">
            </div>
        </div>

        {{-- Bouton enregistrer --}}
        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                💾 Enregistrer
            </button>
        </div>
    </form>
</div>

{{-- JS --}}
<script>
    function enableField(id) {
        const field = document.getElementById(id);
        field.disabled = false;
        field.focus();
    }

    function togglePasswordFields() {
        const section = document.getElementById('password-fields');
        section.classList.toggle('hidden');
    }
</script>

{{-- Styles --}}
<style>
    .input-field {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        background-color: #f9fafb;
    }

    .input-field:disabled {
        background-color: #e5e7eb;
        cursor: not-allowed;
    }

    .hidden {
        display: none;
    }
</style>
@endsection
