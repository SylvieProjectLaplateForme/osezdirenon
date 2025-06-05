@extends('layout')

@section('title', 'Plan du site n')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-pink-700 mb-8 text-center">Plan du site "Osez dire Non"</h1>
<div class="bg-pink-50 border border-pink-200 p-6 rounded-lg mb-10 shadow">
    <p class="mb-4 text-gray-700 leading-relaxed">
        Bienvenue sur le plan du site <strong>"Osez Dire Non"</strong> 🌐
    </p>

    <p class="mb-4 text-gray-700 leading-relaxed">
        Que vous soyez visiteur, lecteur fidèle ou membre connecté, cette page est là pour vous guider facilement à travers toutes les rubriques disponibles sur notre plateforme.
    </p>

    <ul class="list-disc list-inside text-gray-800 space-y-1">
        <li>📖 Découvrez les <strong>derniers articles publiés</strong> selon vos centres d’intérêt</li>
        <li>🔍 Accédez rapidement aux sections utiles : <em>accueil</em>, <em>contact</em>, <em>mentions légales</em>, etc.</li>
        <li>🧑‍💻 Pour les membres connectés, retrouvez vos <strong>publications</strong>, <strong>commentaires</strong> ou <strong>publicités</strong> personnelles</li>
        <li>🛠️ Si vous êtes administrateur ou éditeur, vous trouverez vos outils de gestion dans votre espace dédié</li>
    </ul>

    <p class="mt-4 text-gray-700">
        👉 Utilisez la grille ci-dessous pour accéder directement aux principales pages du site.
    </p>
</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm text-gray-700">

        {{-- 🏠 Navigation principale --}}
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">Navigation</h2>
            <ul class="space-y-1">
                <li><a href="{{ route('home') }}" class="hover:underline">Accueil</a></li>
                <li><a href="{{ route('contact') }}" class="hover:underline">Contact</a></li>
                <li><a href="{{ route('publicites.publiques') }}" class="hover:underline">Publicités</a></li>
            </ul>
        </div>

        {{-- 📝 Espace membre --}}
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">Mon compte</h2>
            <ul class="space-y-1">
                @auth
                    <li><a href="{{ route('editeur.dashboard') }}" class="hover:underline">Dashboard éditeur</a></li>
                    <li><a href="{{ route('logout') }}" class="hover:underline">Déconnexion</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:underline">Connexion</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline">Inscription</a></li>
                @endauth
            </ul>
        </div>

        {{-- 📢 Publicités --}}
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">Publicités</h2>
            <ul class="space-y-1">
                <li><a href="{{ route('editeur.publicites.create') }}" class="hover:underline">Créer une publicité</a></li>
                <li><a href="{{ route('editeur.publicites.index') }}" class="hover:underline">Mes publicités</a></li>
                <li><a href="{{ route('editeur.publicites.payees') }}" class="hover:underline">Publicités payées</a></li>
            </ul>
        </div>

        {{-- ⚙️ Profil --}}
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">Profil</h2>
            <ul class="space-y-1">
                <li><a href="{{ route('editeur.profile.edit') }}" class="hover:underline">Modifier mon profil</a></li>
            </ul>
        </div>

        {{-- ⚖️ Légal --}}
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">Informations légales</h2>
            <ul class="space-y-1">
                <li><a href="{{ route('apropos') }}" class="hover:underline">À propos</a></li>
                <li><a href="{{ route('cgu') }}" class="hover:underline">CGU</a></li>
                <li><a href="{{ route('confidentialite') }}" class="hover:underline">Confidentialité</a></li>
                <li><a href="{{ route('plan') }}" class="hover:underline">Plan du site</a></li>
            </ul>
        </div>

        {{-- 🔐 Admin (optionnel, visible si admin) --}}
        @if(Auth::check() && Auth::user()->role === 'admin')
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">Admin</h2>
            <ul class="space-y-1">
                <li><a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard Admin</a></li>
                <li><a href="{{ route('admin.articles.index') }}" class="hover:underline">Gérer les articles</a></li>
                <li><a href="{{ route('admin.publicites.index') }}" class="hover:underline">Gérer les publicités</a></li>
                <li><a href="{{ route('admin.editeurs.index') }}" class="hover:underline">Liste des éditeurs</a></li>
                <li><a href="{{ route('admin.comments.pending') }}" class="hover:underline">Commentaires en attente</a></li>
                <li><a href="{{ route('admin.profil.index') }}" class="hover:underline">Mon profil admin</a></li>
            </ul>
        </div>
        @endif

    </div>
</div>
@endsection
