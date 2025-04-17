<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Mon Blog Français')</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    
    <body class="flex flex-col min-h-screen bg-white text-gray-800">
    
        {{-- 🔵 En-tête avec logo + navigation alignée --}}
        <header class="bg-white shadow mb-6">
            <div class="container mx-auto flex items-center justify-between p-4">
                {{-- 🔵 Logo à gauche --}}
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-odn.png') }}" alt="Logo Osez Dire Non" class="h-20 w-auto">
                </a>
        
                {{-- 🔵 Bande de navigation à droite --}}
                <div class="flex items-center space-x-6">
                    {{-- Navigation principale --}}
                    @if (Route::currentRouteName() !== 'contact')
                        <nav class="flex space-x-4">
                            <a href="{{ route('home') }}"
                                class="bg-blue-600 text-white px-4 py-2 font-bold hover:bg-blue-700 rounded">Accueil</a>
        
                            <a href="{{ route('contact') }}"
                                class="bg-red-600 text-white px-4 py-2 font-bold hover:bg-red-700 rounded">Contact</a>
                        </nav>
                    @endif
        
                    {{-- Authentification --}}
                    <div class="text-sm">
                        @auth
                            <span class="text-gray-600">Bonjour, {{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Connexion</a>
                            <a href="{{ route('register') }}" class="text-green-600 hover:underline ml-2">S’inscrire</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>
        
    
    {{-- 🔵 Contenu principal --}}
    <main class="flex-1 container mx-auto p-8">
        @yield('content')
    </main>

    {{-- 🔵 Pied de page --}}
    <footer class="bg-gray-900 text-white text-center p-4">
        © {{ date('Y') }} OSEZ dire NON  - Tous droits réservés.
    </footer>

</body>
</html>
