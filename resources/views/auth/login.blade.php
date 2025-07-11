<x-guest-layout>

    {{-- ✅ Message affiché si redirigé depuis le carrousel --}}
    @if (session('message_pub'))
    <div class="bg-yellow-100 border-l-4 border-pink-400 text-yellow-800 px-4 py-3 mb-4 rounded text-sm">
        {{ session('message_pub') }}
    </div>
@endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-3">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            {{-- 
            <div class="flex flex-col items-center mt-3"> --}}
            <button type="submit"
                class="bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-2 rounded transition duration-200">
                {{ __('Log in') }}
            </button>
        </div>

        <div class="flex flex-col items-center mt-3">
            <p class="mt-4 text-sm text-gray-600 text-center">
                Pas encore inscrit ?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                    Créer un compte
                </a>
            </p>
        </div>




        </div>
    </form>
</x-guest-layout>
