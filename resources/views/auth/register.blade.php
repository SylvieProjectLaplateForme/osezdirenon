<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- ✅ Messages d'erreurs --}}
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-100 border border-red-400 p-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded px-4 py-2 shadow-sm"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded px-4 py-2 shadow-sm"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded px-4 py-2 shadow-sm"
                type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirmation mot de passe -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded px-4 py-2 shadow-sm"
                type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <!-- Bouton -->
        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                Déjà inscrit ?
            </a>

            <button type="submit"
                class="bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-2 rounded transition duration-200">
                {{ __("S'inscrire") }}
            </button>
        </div>
    </form>

</x-guest-layout>
