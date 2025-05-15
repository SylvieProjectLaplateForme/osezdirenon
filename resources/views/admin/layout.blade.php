<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-gray-100">
    @stack('scripts')

    {{-- 🔹 Bouton burger sur mobile --}}
    <div class="md:hidden p-4 bg-white shadow flex justify-between items-center">
        <span class="text-lg font-bold">Dashboard {{ Auth::user()->name }}</span>
        <button id="burgerBtn" aria-label="Ouvrir le menu" class="text-gray-700 focus:outline-none">
            ☰
        </button>
    </div>

    {{-- 🔹 Conteneur principal --}}
    <div class="flex min-h-screen">

        {{-- 🔸 Menu latéral --}}
        <aside id="sidebar" class="bg-gray-900 text-white w-64 p-6 space-y-4 fixed md:relative md:block hidden z-50 h-full">

            <div class="flex justify-between items-center md:block">
                <h2 class="text-xl font-bold mb-6 hidden md:block">Dashboard {{ Auth::user()->name }}</h2>
                <button class="md:hidden text-white" onclick="document.getElementById('sidebar').classList.add('hidden')">✕</button>
            </div>

            {{-- Profil --}}
            <a href="{{ route('admin.profil.index') }}" class="block py-2 pl-4 hover:bg-gray-800 rounded">👤 Mon profil</a>

            {{-- Articles --}}
            <div>
                <h3 class="uppercase text-gray-400 text-xs mb-2">Articles</h3>
                <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">🗂 Tous les articles</a>
                <a href="{{ route('admin.articles.valides') }}" class="{{ request()->routeIs('admin.articles.valides') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">✔ Validés</a>
                <a href="{{ route('admin.articles.attente') }}" class="{{ request()->routeIs('admin.articles.attente') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">⏳ En attente</a>
                <a href="{{ route('admin.articles.create') }}" class="{{ request()->routeIs('admin.articles.create') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">✍️ Créer un article</a>
            </div>

            {{-- Publicités --}}
            <div>
                <h3 class="uppercase text-gray-400 text-xs mb-2">Publicités</h3>
                <a href="{{ route('admin.publicites.index') }}" class="{{ request()->routeIs('admin.publicites.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">🗂Toutes les publicités</a>
                <a href="{{ route('admin.publicites.attente') }}" class="{{ request()->routeIs('admin.publicites.attente') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">⏳ En attente</a>
            </div>

            {{-- Éditeurs --}}
            <div>
                <h3 class="uppercase text-gray-400 text-xs mb-2">Éditeurs</h3>
                <a href="{{ route('admin.editeurs.index') }}" class="block py-2 pl-4 hover:bg-gray-800 rounded">Liste des éditeurs</a>
            </div>

            {{-- Retour accueil --}}
            <div class="pt-6 space-y-2">
                <a href="{{ route('home') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">
                    ⬅ Accueil public
                </a>
                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="mt-2 text-sm text-gray-300 hover:text-white">🚪 Déconnexion</button>
                </form>
            </div>
        </aside>

        {{-- 🔸 Contenu principal --}}
        <main class="flex-1 md:ml-34 p-6 bg-gray-100 min-h-screen">
            @yield('content')
        </main>

    </div>

    {{-- 🔹 Script Burger menu --}}
    <script>
        const burger = document.getElementById('burgerBtn');
        const sidebar = document.getElementById('sidebar');

        burger.addEventListener('click', () => {
            sidebar.classList.remove('hidden');
        });
    </script>

</body>
</html>
