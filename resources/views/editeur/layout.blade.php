<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditeur - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

{{-- 🔹 Menu mobile --}}
<div class="md:hidden p-4 bg-white shadow flex justify-between items-center">
    <span class="text-lg font-bold">Dashboard de {{ Auth::user()->name }}</span>
    <button id="burgerBtn" class="text-gray-700 focus:outline-none">
        ☰
    </button>
</div>

<div class="flex min-h-screen">

    {{-- 🔸 Sidebar --}}
    <aside id="sidebar" class="bg-gray-900 text-white w-64 p-6 space-y-4 fixed md:relative md:block hidden z-50 h-full">

        <div class="flex justify-between items-center md:block">
            <a href="{{ route('editeur.dashboard') }}" class="text-xl font-bold mb-6 hidden md:block hover:underline">
    🏠Tableau de bord de {{ Auth::user()->name }}
</a>
            <button class="md:hidden text-white" onclick="document.getElementById('sidebar').classList.add('hidden')">✕</button>
        </div>

        {{-- Profil --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Profil</h3>
            <a href="{{ route('editeur.profile.edit') }}" class="block py-2 pl-4 hover:bg-gray-800 rounded">
                👤 Mon profil
            </a>
        </div>

        {{-- Articles --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Mes articles</h3>
            <a href="{{ route('editeur.articles.index') }}" class="{{ request()->routeIs('editeur.articles.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">
                📝 Tous mes articles
            </a>
            <a href="{{ route('editeur.articles.enAttente') }}" class="{{ request()->routeIs('editeur.articles.enAttente') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">
                ⏳ En attente de validation
            </a>
            <a href="{{ route('editeur.articles.create') }}" class="block py-2 pl-8 hover:bg-gray-800 rounded">
                ➕ Créer un article
            </a>
        </div>

        {{-- Publicités --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Mes publicités</h3>
            <a href="{{ route('editeur.publicites.index') }}" class="{{ request()->routeIs('editeur.publicites.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">
                ✔ Toutes mes publicités
            </a>
            <a href="{{ route('editeur.publicites.enAttente') }}" class="{{ request()->routeIs('editeur.publicites.enAttente') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">
                ⏳ En attente de validation
            </a>
            <a href="{{ route('editeur.publicites.a_payer') }}" class="{{ request()->routeIs('editeur.publicites.a_payer') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">
               💰 À payer
    </a>
           
            <a href="{{ route('editeur.publicites.payees') }}" class="{{ request()->routeIs('editeur.publicites.payees') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">
                 💳 Payées
            </a>
            <a href="{{ route('editeur.publicites.create') }}" class="block py-2 pl-8 hover:bg-gray-800 rounded">
                ➕ Créer une publicité
            </a>
        </div>

        
        


        {{-- Paiements --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Mes paiements</h3>
            <a href="{{ route('editeur.paiements.index') }}" class="{{ request()->routeIs('editeur.paiements.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">
                💰 Tous mes Paiements
            </a>
        </div>

        {{-- Retour Accueil --}}
        <div class="pt-6">
            <a href="{{ route('home') }}" 
               class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">
                ⬅ Retour à l’accueil
            </a>
        </div>
        
    </aside>

    {{-- 🔸 Contenu principal --}}
    <main class="flex-1 md:ml-34 p-6 bg-gray-100 min-h-screen">
        @yield('content')
    </main>

</div>

{{-- 🔹 Script pour menu burger --}}
<script>
    const burger = document.getElementById('burgerBtn');
    const sidebar = document.getElementById('sidebar');

    burger.addEventListener('click', () => {
        sidebar.classList.remove('hidden');
    });
</script>

</body>
</html>