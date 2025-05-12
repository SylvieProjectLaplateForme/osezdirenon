@extends('editeur.layout')

@section('title', 'Mon profil')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">👤 Modifier mon profil</h1>

    {{-- Formulaire de vérification d'email --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Formulaire de mise à jour --}}
    <form method="post" action="{{ route('editeur.profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- Nom --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                class="w-full mt-1 p-2 border border-gray-300 rounded">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                class="w-full mt-1 p-2 border border-gray-300 rounded">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-800">
                    Votre adresse email n'est pas validée.

                    <button form="send-verification"
                        class="underline text-sm text-blue-600 hover:text-blue-800 transition">
                        Cliquez ici pour renvoyer l'e-mail de vérification.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Bouton sauvegarder --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('editeur.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                💾 Sauvegarder
            </button>
        </div>

        @if (session('status') === 'profile-updated')
            <p class="text-sm text-green-600 mt-2">
                ✅ Profil mis à jour avec succès.
            </p>
        @endif
    </form>
</div>
@endsection
