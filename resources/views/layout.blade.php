<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('osez dire non', 'Mon Blog ')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- 🎨 CSS animation pour le bandeau défilant -->
    <style>
        @keyframes marquee {
            0%   { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 30s linear infinite;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-white text-gray-800">

    {{-- 🔵 En-tête avec logo + navigation alignée --}}
    <header class="bg-white shadow mb-6">
        <div class="container mx-auto flex items-center justify-between p-4">
            {{-- 🔵 Logo --}}
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo-odn.png') }}" alt="Logo Osez Dire Non" class="h-20 w-auto">
            </a>

            {{-- 🔵 Navigation --}}
            <div class="flex items-center space-x-6">
                {{-- 🔵 Liens principaux --}}
                <nav class="flex space-x-4">
                    {{-- Accueil --}}
                    <a href="{{ route('home') }}"
                       class="bg-blue-600 text-white px-4 py-2 font-bold hover:bg-blue-700 rounded">
                        Accueil
                    </a>

                    {{-- Contact --}}
                    <a href="{{ route('contact') }}"
                       class="bg-red-600 text-white px-4 py-2 font-bold hover:bg-red-700 rounded">
                        Contact
                    </a>

                    {{-- 🔁 Dashboard selon rôle --}}
@auth
@php
    $user = Auth::user();
@endphp

@if ($user->hasRole('admin'))
    <a href="{{ route('admin.dashboard') }}"
       class="bg-gray-100 text-blue-600 px-4 py-2 font-bold hover:bg-gray-200 rounded">
        Dashboard Admin
    </a>
@elseif ($user->hasRole('editeur'))
    <a href="{{ route('editeur.dashboard') }}"
       class="bg-gray-100 text-blue-600 px-4 py-2 font-bold hover:bg-gray-200 rounded">
        Dashboard Éditeur
    </a>
@endif
@endauth


                


                </nav>

                {{-- 🔐 Authentification --}}
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

    @guest
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="animate-marquee whitespace-nowrap py-3 px-4 text-lg sm:text-xl font-medium">
            “Les raisons de dire 
            <span class="font-extrabold text-red-400">"non"</span> 
            sont toujours plus mobilisatrices que celles de dire “oui”.” 
            👉 <a href="{{ route('login') }}" class="underline font-bold ml-4">Connectez-vous</a> 
            ou Rejoignez-nous pour ✍️  écrire, commenter et participer à la discussion   👉 <a href="{{ route('register') }}" class="underline font-bold">Inscrivez-vous</a>  
        </div>
    </div>
@endguest

    {{-- 🔵 Contenu principal --}}
    <main class="flex-1 container mx-auto p-8">
        @yield('content')
    </main>

   

    <!-- 🔒 Bandeau RGPD -->
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-300 p-4 shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4 hidden">
        <p class="text-sm text-gray-700 text-center sm:text-left">
            En poursuivant votre navigation, vous pouvez accepter ou refuser notre 
            <a href="{{ route('confidentialite') }}" class="text-blue-600 hover:underline">politique de confidentialité</a> et nos 
            <a href="{{ route('cgu') }}" class="text-blue-600 hover:underline">conditions d’utilisation</a>.
        </p>
        <div class="flex gap-2">
            <button id="accept-cookies" class="bg-blue-600 text-white px-4 py-2 text-sm rounded hover:bg-blue-700 transition">
                J'accepte
            </button>
            <button id="refuse-cookies" class="bg-gray-300 text-gray-800 px-4 py-2 text-sm rounded hover:bg-gray-400 transition">
                Je refuse
            </button>
        </div>
    </div>

    <!-- ✅ Script RGPD -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const banner = document.getElementById("cookie-banner");
            const acceptBtn = document.getElementById("accept-cookies");
            const refuseBtn = document.getElementById("refuse-cookies");

            if (!banner || !acceptBtn || !refuseBtn) {
                console.error("❌ RGPD : éléments non trouvés.");
                return;
            }

            const userChoice = localStorage.getItem("rgpdChoice");

            if (!userChoice) {
                banner.classList.remove("hidden"); // Affiche le bandeau
            }

            acceptBtn.addEventListener("click", function () {
                localStorage.setItem("rgpdChoice", "accepted");
                banner.classList.add("hidden");
                console.log("✅ Consentement accepté");
            });

            refuseBtn.addEventListener("click", function () {
                localStorage.setItem("rgpdChoice", "refused");
                banner.classList.add("hidden");
                console.log("❌ Consentement refusé");
            });
        });
    </script>



    {{-- 🔵 Pied de page --}}
    <footer class="bg-gray-900 text-white p-4 text-center text-sm">
        <p class="mb-2">
            © {{ date('Y') }} OSEZ dire NON – Tous droits réservés.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('apropos') }}" class="hover:underline text-blue-300">À propos</a>
            <a href="{{ route('cgu') }}" class="hover:underline text-blue-300">Conditions Générales</a>
            <a href="{{route('confidentialite') }}" class="hover:underline text-blue-300">
    Confidentialité </a>
        </div>
    </footer>
    

</body>
</html>
