@extends('layout')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="max-w-6xl mx-auto py-10 px-4">

        {{-- ✅ Message de confirmation --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6 shadow text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Mise en page à deux colonnes --}}
        <div class="flex flex-col md:flex-row gap-8">

            {{-- 📝 Colonne principale : article --}}
            <div class="md:w-2/3">

                {{-- Titre + auteur --}}
                <h1 class="text-3xl font-bold mb-2">{{ $article->title }}</h1>
                <p class="text-sm text-gray-500 mb-4">
                    Par <strong>{{ $article->user->name ?? 'Anonyme' }}</strong> -
                    {{ $article->created_at->format('d/m/Y') }}
                </p>

                {{-- Image de l’article --}}
                <x-article-image :image="$article->image" :alt="$article->title" class="w-full h-64 object-cover rounded-t-xl" />

                {{-- Contenu de l’article --}}
                <div class="prose max-w-none bg-white p-6 rounded shadow mb-10">
                    {!! nl2br(e($article->content)) !!}
                </div>

                {{-- 💬 Commentaires --}}
                <div class="bg-gray-50 p-6 rounded shadow mb-8">
                    <h2 class="text-2xl font-semibold mb-4">💬 Commentaires</h2>

                    @forelse ($article->comments->where('is_approved', 1) as $comment)
                        <div class="bg-white p-4 rounded shadow mb-3">
                            <p class="text-sm font-semibold text-gray-700">
                                {{ $comment->user->name ?? 'Utilisateur supprimé' }}
                            </p>
                            <p class="mt-1 whitespace-pre-line text-gray-800">{{ $comment->content }}</p>
                            <p class="text-xs text-gray-400 text-right">Posté le
                                {{ $comment->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">Aucun commentaire validé pour le moment.</p>
                    @endforelse
                </div>

                {{-- ✍️ Formulaire de commentaire --}}
                @if (isset($article) && $article instanceof \App\Models\Article && $article->is_approved)
                    <div class="bg-white p-6 rounded shadow">
                        <h3 class="text-xl font-bold mb-4">✍️ Laisser un commentaire</h3>

                        @auth
                            <form method="POST" action="{{ route('comment.store', ['article' => $article]) }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700">Message</label>
                                    <textarea name="content" id="content" rows="4"
                                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required></textarea>
                                </div>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Envoyer
                                </button>
                            </form>
                        @else
                            <p class="text-gray-600">
                                Veuillez <a href="{{ route('login', ['redirect' => request()->fullUrl()]) }}"
                                            class="text-pink-500 underline">vous connecter</a> pour laisser un commentaire.
                            </p>
                        @endauth
                    </div>
                @endif
            </div>

            {{-- 📚 Colonne secondaire : articles similaires --}}
            <aside class="md:w-1/3">
                @if ($similaires->count())
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h2 class="text-lg font-semibold text-pink-600 mb-4">D'autres articles similaires</h2>

                        @foreach ($similaires as $similaire)
                            <div class="mb-4 border-b pb-4">
                                <x-article-image :image="$similaire->image" :alt="$similaire->title"
                                                 class="rounded w-full h-32 object-cover mb-2" />

                                <p class="text-xs text-pink-500 font-medium mb-1">
                                    {{ $similaire->category->name ?? 'Non catégorisé' }} |
                                    {{ $similaire->created_at->format('d/m/Y') }}
                                </p>

                                <a href="{{ route('article.show', $similaire->slug) }}"
                                   class="text-sm font-semibold text-gray-800 hover:text-pink-600 block">
                                    {{ $similaire->title }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </aside>

        </div>
    </div>
@endsection
