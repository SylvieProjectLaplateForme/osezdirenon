<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Osez Dire Non')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ✅ SwiperJS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
</head>

<body class="min-h-screen w-full bg-pink-50 text-gray-800 font-sans antialiased overflow-x-hidden">

    <header class="w-full bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-pink-600 whitespace-nowrap">
                Osez Dire Non
            </a>

            {{-- Menu Burger Mobile --}}
            <div class="md:hidden">
                <button id="menu-btn" class="text-pink-600 text-3xl focus:outline-none">☰</button>
            </div>

            {{-- Menu Desktop --}}
            <nav class="hidden md:flex space-x-4 text-sm items-center font-medium">
                <a href="{{ route('home') }}" class="hover:text-pink-600">Accueil</a>
                <a href="{{ route('contact') }}" class="hover:text-pink-600">Contact</a>

                @guest
                    <a href="{{ route('login') }}" class="hover:text-pink-600">Connexion</a>
                    <a href="{{ route('register') }}" class="hover:text-pink-600">Inscription</a>
                @else
                    <span class="text-pink-600 font-semibold">
                        Bonjour, {{ Auth::user()->name }}
                        @if (Auth::user()->role)
                            <span class="text-xs text-gray-500">({{ Auth::user()->role->name }})</span>
                        @endif
                    </span>

                    @php $role = Auth::user()->role->name ?? null; @endphp
                    @if ($role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-pink-600">Dashboard Admin</a>
                    @elseif ($role === 'editeur')
                        <a href="{{ route('editeur.dashboard') }}" class="hover:text-pink-600">Mon Espace</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
                    </form>
                @endguest
            </nav>
        </div>

        {{-- Menu Mobile --}}
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2 text-sm font-medium">
            <a href="{{ route('home') }}" class="block hover:text-pink-600">Accueil</a>
            <a href="{{ route('contact') }}" class="block hover:text-pink-600">Contact</a>

            @guest
                <a href="{{ route('login') }}" class="block hover:text-pink-600">Connexion</a>
                <a href="{{ route('register') }}" class="block hover:text-pink-600">Inscription</a>
            @else
                <div class="text-pink-600 font-semibold">
                    Bonjour, {{ Auth::user()->name }}
                    @if (Auth::user()->role)
                        <span class="text-xs text-gray-500">({{ Auth::user()->role->name }})</span>

                        {{-- Cloche de notification --}}
                        @if (auth()->user()->unreadNotifications->count())
                            <a href="{{ route('editeur.dashboard') }}" class="relative inline-block ml-2">
                                🔔
                                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </a>
                        @else
                            <a href="{{ route('editeur.dashboard') }}" class="ml-2 text-lg">🔔</a>
                        @endif
                    @endif
                </div>

                @if ($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block hover:text-pink-600">Dashboard Admin</a>
                @elseif ($role === 'editeur')
                    <a href="{{ route('editeur.dashboard') }}" class="block hover:text-pink-600">Mon Espace</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
                </form>
            @endguest
        </div>
    </header>

    {{-- Contenu principal --}}
    <main class="max-w-7xl mx-auto py-10 px-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-10">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-pink-600 font-semibold space-y-2">
            © {{ date('Y') }} Osez Dire Non — Le blog qui vous donne la parole.

            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-2">
                <a href="{{ route('apropos') }}" class="hover:text-gray-600">À propos</a>
                <a href="{{ route('cgu') }}" class="hover:text-gray-600">Conditions Générales</a>
                <a href="{{ route('confidentialite') }}" class="hover:text-gray-600">Confidentialité</a>
                <a href="{{ route('plan') }}" class="hover:text-gray-600">Plan du site</a>
            </div>
        </div>
    </footer>

    {{-- JS menu mobile --}}
    <script>
        document.getElementById('menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    
    {{-- 🔒 Bandeau RGPD responsive --}}
    <div id="cookieConsentBox"
         class="invisible opacity-0 transition-opacity duration-500 fixed bottom-12 left-1/2 transform -translate-x-1/2 bg-black text-white border border-gray-700 shadow-2xl rounded-xl w-[95%] max-w-3xl z-50 p-6 md:p-8 text-center md:text-left space-y-4">
        <h3 class="text-lg md:text-xl font-bold">🍪 Confidentialité & Cookies</h3>
        <p class="text-sm md:text-base leading-relaxed">
            Ce site utilise des cookies pour améliorer votre expérience. En poursuivant votre navigation, vous acceptez
            notre
            <a href="{{ route('confidentialite') }}" class="text-pink-500 underline hover:text-pink-400">
                politique de confidentialité
            </a>.
        </p>
        <div class="flex flex-col sm:flex-row justify-center md:justify-end gap-3">
            <button id="acceptCookies"
                    class="bg-pink-600 text-white text-sm px-6 py-2 rounded hover:bg-pink-700 transition">
                J'accepte
            </button>
            <button id="rejectCookies"
                    class="bg-white text-black text-sm px-6 py-2 rounded hover:bg-gray-200 transition">
                Je refuse
            </button>
        </div>
    </div>

    {{-- Script RGPD --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const banner = document.getElementById('cookieConsentBox');
            const acceptBtn = document.getElementById('acceptCookies');
            const rejectBtn = document.getElementById('rejectCookies');

            const consent = localStorage.getItem('cookieConsent');

            if (consent === 'accepted' || consent === 'rejected') {
                // ne rien faire
            } else {
                banner.classList.remove('invisible', 'opacity-0');
                banner.classList.add('opacity-100');
            }

            const handleConsent = (value) => {
                localStorage.setItem('cookieConsent', value);
                banner.classList.remove('opacity-100');
                banner.classList.add('opacity-0');
                setTimeout(() => banner.classList.add('invisible'), 500);
            };

            acceptBtn?.addEventListener('click', () => handleConsent('accepted'));
            rejectBtn?.addEventListener('click', () => handleConsent('rejected'));
        });
    </script>

</body>
</html>
