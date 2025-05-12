<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditeur - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

    {{-- Menu latéral --}}
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-6 space-y-4">

        <h2 class="text-xl font-bold mb-6">Bienvenue {{ Auth::user()->name }}</h2>

        {{-- Profil --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Profil</h3>
            <a href="{{ route('editeur.profile.edit') }}" class="block py-2 pl-4 hover:bg-gray-800 rounded">
                👤  Mon profil
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
                ⏳ En attente
            </a>
            <a href="{{ route('editeur.publicites.payees') }}" class="{{ request()->routeIs('editeur.publicites.payees') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">
                💳 Payées
            </a>
            <a href="{{ route('editeur.publicites.create') }}" class="block py-2 pl-8 hover:bg-gray-800 rounded">
                ➕ Créer une publicité
            </a>
        </div>
  {{-- paiements --}}
  <div>
    <h3 class="uppercase text-gray-400 text-xs mb-2"> Mes paiements</h3>
    <a href="{{ route('editeur.paiements.index') }}" class="{{ request()->routeIs('editeur.paiements.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">
        💰 Toutes mes Paiements
    </a>
    {{-- <a href="{{ route('editeur.publicites.enAttente') }}" class="{{ request()->routeIs('editeur.publicites.enAttente') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">
        ⏳ En attente --}}

        {{-- Retour Accueil --}}
        <div class="pt-6">
            <a href="{{ route('home') }}" 
               class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">
                ⬅ Retour à l’accueil
            </a>
        </div>

    </aside>

    {{-- Contenu principal --}}
    <main class="flex-1 p-10 bg-gray-100">
        @yield('content')
    </main>

</div>

</body>
</html>
