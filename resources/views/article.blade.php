<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    <!-- LIEN VERS TON FAVICON -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-8">

        <!-- Message succès après envoi d'un commentaire -->
        @if (session('success'))
            <div id="success-message" class="bg-green-200 text-green-800 p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    var message = document.getElementById('success-message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 3000);
            </script>
        @endif

        <!-- TITRE centré -->
        <h1 class="text-4xl font-bold mb-6 text-center">{{ $article->title }}</h1>

        
    @if ($article->image)
    <img src="{{ asset('storage/' . $article->image) }}"
         alt="{{ $article->title }}"
         class="w-full h-auto rounded-lg shadow-md">
@endif



        <!-- CATEGORIE centrée -->
        <p class="text-center mb-6">
            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $article->category->color_class }}">
                {{ $article->category->name }}
            </span>
        </p>
        

        <!-- CONTENU de l'article -->
        {{-- <div class="mb-8">
            {!! $article->content !!}
        </div> --}}
        {{-- permet d’afficher du HTML brut, comme les balises <img>, <p>, --}}
        <div class="prose max-w-none">
            {!! $article->content !!}
        </div>
        

        <!-- COMMENTAIRES EXISTANTS -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Commentaires</h2>

            @forelse ($article->comments as $comment)
            <div class="bg-white p-4 rounded shadow mb-4">
                <p class="font-semibold">{{ $comment->author }}</p>
    
                <!-- ✅ Affiche le contenu en HTML (iframe, lien, etc.) -->
                <div class="text-gray-700 mt-2">
                    {!! $comment->content !!}
                </div>
    
                <p class="text-sm text-gray-500 text-right mt-2">
                    Posté le {{ $comment->created_at->format('d/m/Y') }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">Aucun commentaire pour cet article pour l'instant.</p>
        @endforelse
    </div>

        <!-- FORMULAIRE POUR AJOUTER UN COMMENTAIRE -->
        <div class="mt-12">
            <h3 class="text-xl font-semibold mb-4">Ajouter un commentaire</h3>

            <form action="{{ route('comment.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">

                <input type="text" name="author" placeholder="Votre nom" class="w-full p-2 border rounded" required>

                <textarea name="content" rows="4" placeholder="Votre commentaire..." class="w-full p-2 border rounded" required></textarea>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                    Envoyer
                </button>
            </form>
        </div>

        <!-- LIEN RETOUR À L'ACCUEIL -->
        <div class="mt-12 text-center">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline">&larr; Retour à l'accueil</a>
        </div>

    </div>

</body>
</html>
