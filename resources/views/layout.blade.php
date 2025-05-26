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
<body class="bg-pink-50 text-gray-800 font-sans">

<header class="bg-white shadow sticky top-0 z-50">
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
                    @if(Auth::user()->role)
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
                @if(Auth::user()->role)
                    <span class="text-xs text-gray-500">({{ Auth::user()->role->name }})</span>
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
    <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-pink-600 font-semibold">
        © {{ date('Y') }} Osez Dire Non — Le blog qui vous donne la parole.
        <div class="flex justify-center gap-4">
            <a href="{{ route('apropos') }}" class="hover:text-gray-600">À propos</a>
            <a href="{{ route('cgu') }}" class="hover:text-gray-600">Conditions Générales</a>
            <a href="{{ route('confidentialite') }}" class="hover:text-gray-600">Confidentialité</a>
            <a href="{{ route('plan')}}" class="hover:text-gray-600">Plan du site</a>
        </div>
        
    </div>
</footer>

{{-- JS menu mobile --}}
<script>
    document.getElementById('menu-btn').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
<!-- 🔒 Bandeau RGPD -->

<div id="cookieConsentCard" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-white border border-gray-300 shadow-xl rounded-xl max-w-md w-[95%] md:w-[420px] z-50 p-4 text-center space-y-3">
    <h3 class="text-lg font-semibold text-pink-600">Confidentialité & Cookies 🍪</h3>
    <p class="text-sm text-gray-600">
        Ce site utilise des cookies pour améliorer votre expérience. En poursuivant, vous acceptez notre 
        <a href="{{ route('confidentialite') }}" class="text-pink-600 underline hover:text-pink-700">politique de confidentialité</a>.
    </p>
    <div class="flex justify-center space-x-4">
        <button id="acceptCookies" class="bg-pink-600 text-white text-sm px-4 py-2 rounded hover:bg-pink-700 transition">
            J'accepte
        </button>
        <button id="rejectCookies" class="bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded hover:bg-gray-300 transition">
            Je refuse
        </button>
    </div>
</div>

<!-- 🧠 Script RGPD -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const banner = document.getElementById('cookieConsentCard');
        const acceptBtn = document.getElementById('acceptCookies');
        const rejectBtn = document.getElementById('rejectCookies');

        // Vérifie si déjà traité
        if (localStorage.getItem('cookieConsent') === 'accepted' || localStorage.getItem('cookieConsent') === 'rejected') {
            banner.style.display = 'none';
        }

        // Accepter
        acceptBtn.addEventListener('click', () => {
            localStorage.setItem('cookieConsent', 'accepted');
            banner.style.display = 'none';
        });

        // Refuser
        rejectBtn.addEventListener('click', () => {
            localStorage.setItem('cookieConsent', 'rejected');
            banner.style.display = 'none';
        });
    });
</script>

</body>
</html>
