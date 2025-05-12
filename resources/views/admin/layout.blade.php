<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

    {{-- Menu latéral --}}
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-6 space-y-4">

        <h2 class="text-xl font-bold mb-6">Dashboard {{ Auth::user()->name }}</h2>

        
      <div class="space-y-2">
        
       

         <a href="{{ route('admin.profil.index') }}" <h3 class="uppercase text-white-900 text-xs mb-2">👤 Mon profil</h3></a>

        
    </div>  
    

        {{-- Articles --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Articles</h3>
            <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded">Tous les articles</a>
            <a href="{{ route('admin.articles.valides') }}" class="{{ request()->routeIs('admin.articles.valides') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">✔ Articles validés</a>
            <a href="{{ route('admin.articles.attente') }}" class="{{ request()->routeIs('admin.articles.attente') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">⏳ Articles en attente</a>
        </div>

        {{-- Publicités --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Publicités</h3>
            <a href="{{ route('admin.publicites.index') }}" class="{{ request()->routeIs('admin.publicites.index') ? 'bg-gray-800' : '' }} block py-2 pl-4 hover:bg-gray-800 rounded"> ✔ Toutes les publicités</a>
            <a href="{{ route('admin.publicites.attente') }}" class="{{ request()->routeIs('admin.publicites.attente') ? 'bg-gray-800' : '' }} block py-2 pl-8 hover:bg-gray-800 rounded">⏳ Publicités en attente</a>
        </div>

        {{-- Editeurs --}}
        <div>
            <h3 class="uppercase text-gray-400 text-xs mb-2">Éditeurs</h3>
            <a href="{{ route('admin.editeurs.index') }}" class="text-white hover:underline">
                Liste des éditeurs
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

    {{-- Contenu principal --}}
    <main class="flex-1 p-10 bg-gray-100">
        @yield('content')
    </main>

</div>

</body>
</html>